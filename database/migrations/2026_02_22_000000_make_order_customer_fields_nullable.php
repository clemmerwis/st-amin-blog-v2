<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Makes customer_email, customer_name, and shipping_address nullable
     * to align the schema with StripeController's null-safe ?? null writes.
     *
     * Uses raw SQL instead of Blueprint->change() to avoid the doctrine/dbal
     * dependency conflict with carbonphp/carbon-doctrine-types on this stack.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE orders MODIFY COLUMN customer_email VARCHAR(255) NULL');
        DB::statement('ALTER TABLE orders MODIFY COLUMN customer_name VARCHAR(255) NULL');
        DB::statement('ALTER TABLE orders MODIFY COLUMN shipping_address JSON NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE orders MODIFY COLUMN customer_email VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE orders MODIFY COLUMN customer_name VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE orders MODIFY COLUMN shipping_address JSON NOT NULL');
    }
};
