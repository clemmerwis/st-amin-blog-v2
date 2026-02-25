<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Post;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $post = Post::where('featured', true)->first();

        if (!$post) {
            return;
        }

        Order::create([
            'post_id' => $post->id,
            'stripe_session_id' => 'cs_test_seed_' . uniqid(),
            'customer_email' => 'jane.doe@example.com',
            'customer_name' => 'Jane Doe',
            'shipping_address' => [
                'line1' => '123 Main St',
                'line2' => 'Apt 4B',
                'city' => 'Milwaukee',
                'state' => 'WI',
                'postal_code' => '53202',
                'country' => 'US',
            ],
            'amount' => $post->product_price ?? 3369,
        ]);

        Order::create([
            'post_id' => $post->id,
            'stripe_session_id' => 'cs_test_seed_' . uniqid(),
            'customer_email' => 'john.smith@example.com',
            'customer_name' => 'John Smith',
            'shipping_address' => [
                'line1' => '456 Oak Ave',
                'city' => 'Madison',
                'state' => 'WI',
                'postal_code' => '53703',
                'country' => 'US',
            ],
            'amount' => $post->product_price ?? 3369,
            'fulfillment_status' => 'fulfilled',
            'tracking_number' => '1Z999AA10123456784',
        ]);
    }
}
