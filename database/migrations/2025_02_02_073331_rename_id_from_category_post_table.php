<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RenameIdFromCategoryPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('category_post', 'id')) {
            Schema::table('category_post', function (Blueprint $table) {
                DB::statement("
                    ALTER TABLE `category_post`
                    CHANGE `id` `pivot_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT
                ");
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('category_post', 'pivot_id')) {
            Schema::table('category_post', function (Blueprint $table) {
                DB::statement("
                    ALTER TABLE `category_post`
                    CHANGE `pivot_id` `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT
                ");
            });
        }
    }
}