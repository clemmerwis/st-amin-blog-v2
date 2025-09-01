<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Webhook;
use App\Models\Post;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
    }
    
    /**
     * Create checkout session for a post
     */
    public function checkout(Post $post)
    {
        abort_unless($post->featured, 404);
        
        try {
            $session = Session::create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $post->title,
                        ],
                        'unit_amount' => 2500,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'shipping_address_collection' => [
                    'allowed_countries' => ['US'],
                ],
                'success_url' => url("/blog/{$post->slug}?purchased=1"),
                'cancel_url' => url("/blog/{$post->slug}"),
                'metadata' => [
                    'post_id' => $post->id,
                ],
            ]);
            
            return response()->json(['url' => $session->url]);
            
        } catch (\Exception $e) {
            Log::error('Stripe error: ' . $e->getMessage());
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
                env('STRIPE_WEBHOOK_SECRET')
            );
        } catch(\Exception $e) {
            return response('', 400);
        }
        
        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            
            Order::create([
                'post_id' => $session->metadata->post_id,
                'stripe_session_id' => $session->id,
                'customer_email' => $session->customer_details->email,
                'customer_name' => $session->customer_details->name,
                'shipping_address' => $session->shipping_details->address,
                'amount' => $session->amount_total,
            ]);
        }
        
        return response('', 200);
    }
}