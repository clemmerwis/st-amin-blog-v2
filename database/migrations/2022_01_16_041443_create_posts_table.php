<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->string('title')->unique();
            $table->string('slug')->unique();

            $table->text('body');
            $table->text('excerpt')->nullable();
            $table->string('image_path')->nullable();

            $table->boolean('active')->default(true);
            $table->boolean('featured')->default(false);

            $table->foreignId('author_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('category_id')
                ->constrained('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->nullable();

            $table->timestamps();
            $table->timestamp('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
