<?php

namespace Tests\Feature;

use App\Mail\OrderPlaced;
use App\Models\Order;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class StripeWebhookTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Set a known webhook secret for testing
        Config::set('services.stripe.webhook_secret', 'whsec_test_secret');
    }

    /**
     * Generate a valid Stripe webhook signature for testing.
     */
    protected function generateStripeSignature(string $payload, int $timestamp = null): string
    {
        $timestamp = $timestamp ?? time();
        $secret = config('services.stripe.webhook_secret');
        $signedPayload = "{$timestamp}.{$payload}";
        $signature = hash_hmac('sha256', $signedPayload, $secret);

        return "t={$timestamp},v1={$signature}";
    }

    /**
     * Create a mock checkout.session.completed event payload.
     */
    protected function createCheckoutSessionPayload(int $postId, string $sessionId = 'cs_test_123'): string
    {
        return json_encode([
            'id' => 'evt_test_123',
            'type' => 'checkout.session.completed',
            'data' => [
                'object' => [
                    'id' => $sessionId,
                    'metadata' => [
                        'post_id' => $postId,
                    ],
                    'customer_details' => [
                        'email' => 'test@example.com',
                        'name' => 'Test Customer',
                    ],
                    'shipping_details' => [
                        'address' => [
                            'line1' => '123 Test St',
                            'city' => 'Test City',
                            'state' => 'TS',
                            'postal_code' => '12345',
                            'country' => 'US',
                        ],
                    ],
                    'amount_total' => 1999,
                ],
            ],
        ]);
    }

    /**
     * Test webhook rejects invalid signature.
     */
    public function test_webhook_rejects_invalid_signature()
    {
        $payload = $this->createCheckoutSessionPayload(1);

        $response = $this->postJson('/stripe/webhook', [], [
            'Stripe-Signature' => 'invalid_signature',
            'Content-Type' => 'application/json',
        ]);

        $response->assertStatus(400);
    }

    /**
     * Test webhook rejects when post_id is missing from metadata.
     */
    public function test_webhook_rejects_missing_post_id()
    {
        $payload = json_encode([
            'id' => 'evt_test_123',
            'type' => 'checkout.session.completed',
            'data' => [
                'object' => [
                    'id' => 'cs_test_123',
                    'metadata' => [],
                    'customer_details' => [
                        'email' => 'test@example.com',
                        'name' => 'Test Customer',
                    ],
                    'shipping_details' => [
                        'address' => [],
                    ],
                    'amount_total' => 1999,
                ],
            ],
        ]);

        $signature = $this->generateStripeSignature($payload);

        $response = $this->call('POST', '/stripe/webhook', [], [], [], [
            'HTTP_STRIPE_SIGNATURE' => $signature,
            'CONTENT_TYPE' => 'application/json',
        ], $payload);

        $response->assertStatus(400);
    }

    /**
     * Test webhook rejects when post doesn't exist.
     */
    public function test_webhook_rejects_nonexistent_post()
    {
        $payload = $this->createCheckoutSessionPayload(99999);
        $signature = $this->generateStripeSignature($payload);

        $response = $this->call('POST', '/stripe/webhook', [], [], [], [
            'HTTP_STRIPE_SIGNATURE' => $signature,
            'CONTENT_TYPE' => 'application/json',
        ], $payload);

        $response->assertStatus(400);
    }

    /**
     * Test webhook creates order on valid event.
     */
    public function test_webhook_creates_order_on_valid_event()
    {
        $admin = User::factory()->admin()->create();
        $post = Post::factory()->featured()->create(['author_id' => $admin->id]);

        $payload = $this->createCheckoutSessionPayload($post->id, 'cs_unique_' . time());
        $signature = $this->generateStripeSignature($payload);

        $response = $this->call('POST', '/stripe/webhook', [], [], [], [
            'HTTP_STRIPE_SIGNATURE' => $signature,
            'CONTENT_TYPE' => 'application/json',
        ], $payload);

        $response->assertStatus(200);
        $this->assertDatabaseHas('orders', [
            'post_id' => $post->id,
            'customer_email' => 'test@example.com',
        ]);
    }

    /**
     * Test webhook prevents duplicate orders (idempotency).
     */
    public function test_webhook_prevents_duplicate_orders()
    {
        $admin = User::factory()->admin()->create();
        $post = Post::factory()->featured()->create(['author_id' => $admin->id]);

        // Create existing order with same session ID
        Order::create([
            'post_id' => $post->id,
            'stripe_session_id' => 'cs_duplicate_test',
            'customer_email' => 'existing@example.com',
            'customer_name' => 'Existing Customer',
            'shipping_address' => ['line1' => '123 Old St'],
            'amount' => 1999,
        ]);

        $payload = $this->createCheckoutSessionPayload($post->id, 'cs_duplicate_test');
        $signature = $this->generateStripeSignature($payload);

        $response = $this->call('POST', '/stripe/webhook', [], [], [], [
            'HTTP_STRIPE_SIGNATURE' => $signature,
            'CONTENT_TYPE' => 'application/json',
        ], $payload);

        // Should return 200 (success) but not create duplicate
        $response->assertStatus(200);
        $this->assertEquals(1, Order::where('stripe_session_id', 'cs_duplicate_test')->count());
    }

    /**
     * Test webhook sends admin notification email on valid order (populated customer).
     */
    public function test_webhook_sends_admin_email_on_valid_order()
    {
        Mail::fake();
        Config::set('mail.order.address', 'admin@example.com');

        $admin = User::factory()->admin()->create();
        $post = Post::factory()->featured()->create(['author_id' => $admin->id]);

        $payload = $this->createCheckoutSessionPayload($post->id, 'cs_mail_test_' . time());
        $signature = $this->generateStripeSignature($payload);

        $response = $this->call('POST', '/stripe/webhook', [], [], [], [
            'HTTP_STRIPE_SIGNATURE' => $signature,
            'CONTENT_TYPE' => 'application/json',
        ], $payload);

        $response->assertStatus(200);

        Mail::assertSent(OrderPlaced::class, function ($mail) use ($post) {
            return $mail->hasTo('admin@example.com')
                && $mail->order->post_id === $post->id;
        });
    }

    /**
     * Test webhook sends admin email even when customer fields are null.
     */
    public function test_webhook_sends_admin_email_with_null_customer_fields()
    {
        Mail::fake();
        Config::set('mail.order.address', 'admin@example.com');

        $admin = User::factory()->admin()->create();
        $post = Post::factory()->featured()->create(['author_id' => $admin->id]);

        $payload = json_encode([
            'id' => 'evt_null_customer_test',
            'type' => 'checkout.session.completed',
            'data' => [
                'object' => [
                    'id' => 'cs_null_customer_' . time(),
                    'metadata' => [
                        'post_id' => $post->id,
                    ],
                    'customer_details' => null,
                    'shipping_details' => null,
                    'amount_total' => 2500,
                ],
            ],
        ]);

        $signature = $this->generateStripeSignature($payload);

        $response = $this->call('POST', '/stripe/webhook', [], [], [], [
            'HTTP_STRIPE_SIGNATURE' => $signature,
            'CONTENT_TYPE' => 'application/json',
        ], $payload);

        $response->assertStatus(200);

        Mail::assertSent(OrderPlaced::class);

        $this->assertDatabaseHas('orders', [
            'post_id' => $post->id,
            'customer_email' => null,
        ]);
    }

    /**
     * Test webhook returns 200 and creates order even when admin email is not configured.
     */
    public function test_webhook_returns_200_when_admin_email_not_configured()
    {
        Mail::fake();
        Config::set('mail.order.address', null);

        $admin = User::factory()->admin()->create();
        $post = Post::factory()->featured()->create(['author_id' => $admin->id]);

        $payload = $this->createCheckoutSessionPayload($post->id, 'cs_no_email_' . time());
        $signature = $this->generateStripeSignature($payload);

        $response = $this->call('POST', '/stripe/webhook', [], [], [], [
            'HTTP_STRIPE_SIGNATURE' => $signature,
            'CONTENT_TYPE' => 'application/json',
        ], $payload);

        $response->assertStatus(200);

        $this->assertDatabaseHas('orders', ['post_id' => $post->id]);

        Mail::assertNotSent(OrderPlaced::class);
    }
}
