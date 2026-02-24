<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Add product_type enum to posts to distinguish digital vs physical fulfillment.
     * NULL means the post has no product for sale (most posts are articles, not products).
     * Uses raw SQL to avoid doctrine/dbal dependency conflict.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE posts ADD COLUMN product_type ENUM('digital','physical') NULL DEFAULT NULL AFTER product_image_url");
    }

    public function down()
    {
        DB::statement('ALTER TABLE posts DROP COLUMN product_type');
    }
};
