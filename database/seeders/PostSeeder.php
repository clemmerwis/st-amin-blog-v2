<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Detail;
use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 26; $i++) {
            $cats = [];
            $parentCategory = Category::where('id', '<=', 5)->inRandomOrder()->take(1)->get()[0];
            $cats[] = $parentCategory;
            $subcats = Category::find($parentCategory->id)->subcats;
            $subcats = $subcats->random(rand(1,$subcats->count()));
            $cats[] = $subcats;
            $post = Post::factory()
                ->count(1)
                ->hasAttached([...$cats])
                ->create(['image_path' => 'img/categories-grid/cg-'. rand(1, 10) .'.jpg']);
            $post->each(function ($p) {
                    $p->detail()->save(Detail::factory()->make());
                });
        }
    }
}
