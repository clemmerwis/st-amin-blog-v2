<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Webhook;
use App\Mail\OrderPlaced;
use App\Models\Post;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class StripeController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create checkout session for a post
     */
    public function checkout(Post $post)
    {
        abort_unless($post->is_purchasable, 404);

        try {
            $session = Session::create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $post->product_name,
                        ],
                        'unit_amount' => $post->product_price
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'shipping_address_collection' => [
                    'allowed_countries' => ['US'],
                ],
                'success_url' => url("/posts/magazine/{$post->slug}?purchased=1"),
                'cancel_url' => url("/posts/magazine/{$post->slug}"),
                'metadata' => [
                    'post_id' => $post->id,
                ],
            ]);

            return response()->json(['url' => $session->url]);

        } catch (\Exception $e) {
            Log::error('Stripe checkout error: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to create checkout'], 500);
        }
    }

    /**
     * Handle Stripe webhooks
     */
    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                config('services.stripe.webhook_secret')
            );
        } catch(\Exception $e) {
            Log::warning('Stripe webhook: Invalid signature', [
                'error' => $e->getMessage()
            ]);
            return response('', 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;

            // Validate required metadata
            $postId = $session->metadata->post_id ?? null;
            if (!$postId) {
                Log::error('Stripe webhook: Missing post_id in metadata', [
                    'session_id' => $session->id
                ]);
                return response('', 400);
            }

            // Validate post exists
            $post = Post::find($postId);
            if (!$post) {
                Log::error('Stripe webhook: Post not found', [
                    'post_id' => $postId,
                    'session_id' => $session->id
                ]);
                return response('', 400);
            }

            // Idempotency check - prevent duplicate orders
            if (Order::where('stripe_session_id', $session->id)->exists()) {
                Log::info('Stripe webhook: Duplicate session, skipping', [
                    'session_id' => $session->id
                ]);
                return response('', 200);
            }

            // Create order with null-safe property access
            try {
                $order = Order::create([
                    'post_id' => $postId,
                    'stripe_session_id' => $session->id,
                    'customer_email' => $session->customer_details->email ?? null,
                    'customer_name' => $session->customer_details->name ?? null,
                    'shipping_address' => $session->shipping_details->address ?? null,
                    'amount' => $session->amount_total,
                ]);

                Log::info('Stripe webhook: Order created', [
                    'post_id' => $postId,
                    'session_id' => $session->id,
                    'amount' => $session->amount_total
                ]);

                // Send admin notification email
                $adminEmail = config('mail.order.address');
                if ($adminEmail) {
                    try {
                        $order->loadMissing('post');
                        Mail::to($adminEmail)->send(new OrderPlaced($order));
                        Log::info('OrderPlaced mail sent', ['order_id' => $order->id]);
                    } catch (\Exception $e) {
                        Log::error('OrderPlaced mail failed', [
                            'order_id' => $order->id,
                            'error' => $e->getMessage(),
                        ]);
                    }
                } else {
                    Log::warning('ADMIN_ORDER_EMAIL not configured — order notification skipped', [
                        'order_id' => $order->id,
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Stripe webhook: Failed to create order', [
                    'error' => $e->getMessage(),
                    'post_id' => $postId,
                    'session_id' => $session->id
                ]);
                // Return 200 to prevent Stripe retries for DB errors
                // Manual intervention needed - check logs
            }
        }

        return response('', 200);
    }
}
