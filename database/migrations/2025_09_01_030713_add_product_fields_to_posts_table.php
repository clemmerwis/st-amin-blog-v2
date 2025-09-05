<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductFieldsToPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('product_price')->nullable()->after('featured');
            $table->string('product_name')->nullable()->after('product_price');
            $table->string('product_image_url')->nullable()->after('product_name');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['product_price', 'product_name', 'product_image_url']);
        });
    }
}