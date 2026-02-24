<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Add freeform notes column to orders for internal fulfillment tracking.
     * Uses raw SQL to avoid doctrine/dbal dependency conflict.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE orders ADD COLUMN notes TEXT NULL AFTER tracking_number');
    }

    public function down()
    {
        DB::statement('ALTER TABLE orders DROP COLUMN notes');
    }
};
