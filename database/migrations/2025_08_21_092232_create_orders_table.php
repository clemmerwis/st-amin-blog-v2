<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained();
            $table->string('stripe_session_id')->unique();
            $table->string('customer_email');
            $table->string('customer_name');
            $table->json('shipping_address');
            $table->integer('amount');
            $table->string('payment_status')->default('paid');
            $table->enum('fulfillment_status', ['unfulfilled', 'fulfilled'])->default('unfulfilled');
            $table->string('tracking_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}