<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Set existing nulls to physical
        DB::statement("UPDATE posts SET product_type = 'physical' WHERE product_type IS NULL");
        // Change default from NULL to physical
        DB::statement("ALTER TABLE posts MODIFY COLUMN product_type ENUM('digital','physical') NOT NULL DEFAULT 'physical'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE posts MODIFY COLUMN product_type ENUM('digital','physical') NULL DEFAULT NULL");
    }
};
