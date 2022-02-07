<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Detail;
use App\Models\Post;
use App\Models\Category;
use Database\Factories\DetailFactory;

class DetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $posts = Post::all();
        // // foreach ($post as $key => $value) {
        // //     Detail::factory()->for($post);
        // // }
        // $posts->each(function ($item, $key) {
        //     Detail::factory()
        //         ->forPost($item)
        //         ->create();
        // });
    }
}
