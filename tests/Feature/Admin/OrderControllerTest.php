<?php

namespace Tests\Feature\Admin;

use App\Models\Order;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guest cannot access orders API (returns 401).
     */
    public function test_guest_cannot_access_orders_api()
    {
        $response = $this->getJson('/api/admin/orders');

        $response->assertStatus(401);
    }

    /**
     * Test non-admin is redirected from orders API (not 403).
     *
     * The isAdminMiddleware redirects to home rather than returning 403.
     */
    public function test_non_admin_redirected_from_orders_api()
    {
        $user = User::factory()->create(['is_admin' => 0]);

        $response = $this->actingAs($user)->get('/api/admin/orders');

        $response->assertRedirect(route('home'));
    }

    /**
     * Test admin can list orders with correct JSON structure.
     */
    public function test_admin_can_list_orders()
    {
        $admin = User::factory()->admin()->create();
        $post = Post::factory()->featured()->create(['author_id' => $admin->id]);

        Order::create([
            'post_id'          => $post->id,
            'stripe_session_id' => 'cs_test_list',
            'amount'           => 2500,
        ]);

        $response = $this->actingAs($admin)->getJson('/api/admin/orders');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                ['id', 'customer_name', 'amount', 'fulfillment_status', 'post_title'],
            ],
        ]);
    }

    /**
     * Test order amount is formatted as a dollar string (cents to dollars).
     */
    public function test_order_amount_formatted_as_dollar_string()
    {
        $admin = User::factory()->admin()->create();
        $post = Post::factory()->featured()->create(['author_id' => $admin->id]);

        Order::create([
            'post_id'          => $post->id,
            'stripe_session_id' => 'cs_test_format',
            'amount'           => 1200,
        ]);

        $response = $this->actingAs($admin)->getJson('/api/admin/orders');

        $response->assertStatus(200);
        $response->assertJsonPath('data.0.amount', '$12.00');
    }

    /**
     * Test admin can filter orders by fulfillment_status.
     */
    public function test_admin_can_filter_orders_by_status()
    {
        $admin = User::factory()->admin()->create();
        $post = Post::factory()->featured()->create(['author_id' => $admin->id]);

        // Default status is unfulfilled
        Order::create([
            'post_id'          => $post->id,
            'stripe_session_id' => 'cs_test_filter_1',
            'amount'           => 1000,
        ]);

        // Fulfilled order
        Order::create([
            'post_id'            => $post->id,
            'stripe_session_id'  => 'cs_test_filter_2',
            'amount'             => 1000,
            'fulfillment_status' => 'fulfilled',
        ]);

        $response = $this->actingAs($admin)->getJson('/api/admin/orders?status=unfulfilled');

        $response->assertStatus(200);
        $this->assertCount(1, $response->json('data'));
    }

    /**
     * Test admin can view a single order.
     */
    public function test_admin_can_view_single_order()
    {
        $admin = User::factory()->admin()->create();
        $post = Post::factory()->featured()->create(['author_id' => $admin->id]);

        $order = Order::create([
            'post_id'          => $post->id,
            'stripe_session_id' => 'cs_test_show',
            'amount'           => 1999,
        ]);

        $response = $this->actingAs($admin)->getJson("/api/admin/orders/{$order->id}");

        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $order->id);
    }

    /**
     * Test admin can update order fulfillment status.
     */
    public function test_admin_can_update_order_fulfillment_status()
    {
        $admin = User::factory()->admin()->create();
        $post = Post::factory()->featured()->create(['author_id' => $admin->id]);

        $order = Order::create([
            'post_id'          => $post->id,
            'stripe_session_id' => 'cs_test_update_status',
            'amount'           => 1999,
        ]);

        $response = $this->actingAs($admin)->patchJson("/api/admin/orders/{$order->id}", [
            'fulfillment_status' => 'fulfilled',
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('data.fulfillment_status', 'fulfilled');
        $this->assertDatabaseHas('orders', [
            'id'                 => $order->id,
            'fulfillment_status' => 'fulfilled',
        ]);
    }

    /**
     * Test admin can update order notes.
     */
    public function test_admin_can_update_order_notes()
    {
        $admin = User::factory()->admin()->create();
        $post = Post::factory()->featured()->create(['author_id' => $admin->id]);

        $order = Order::create([
            'post_id'          => $post->id,
            'stripe_session_id' => 'cs_test_update_notes',
            'amount'           => 1999,
        ]);

        $response = $this->actingAs($admin)->patchJson("/api/admin/orders/{$order->id}", [
            'notes' => 'Shipped via USPS',
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('data.notes', 'Shipped via USPS');
    }

    /**
     * Test update rejects an invalid fulfillment_status value (422).
     */
    public function test_update_rejects_invalid_fulfillment_status()
    {
        $admin = User::factory()->admin()->create();
        $post = Post::factory()->featured()->create(['author_id' => $admin->id]);

        $order = Order::create([
            'post_id'          => $post->id,
            'stripe_session_id' => 'cs_test_invalid',
            'amount'           => 1999,
        ]);

        $response = $this->actingAs($admin)->patchJson("/api/admin/orders/{$order->id}", [
            'fulfillment_status' => 'invalid_status',
        ]);

        $response->assertStatus(422);
    }

    /**
     * Test admin can access the orders Blade page.
     */
    public function test_admin_can_access_orders_page()
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get('/admin/orders');

        $response->assertStatus(200);
    }
}
