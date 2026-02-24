<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Remove dead payment_status column from orders.
     * Every order is paid by definition (created only on checkout.session.completed).
     * Column is not in $fillable and is never written to by any code.
     * Uses raw SQL to avoid doctrine/dbal dependency conflict.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE orders DROP COLUMN payment_status');
    }

    public function down()
    {
        DB::statement("ALTER TABLE orders ADD COLUMN payment_status VARCHAR(255) NOT NULL DEFAULT 'paid' AFTER amount");
    }
};
