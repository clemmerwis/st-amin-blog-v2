<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use Faker\Generator as Faker;
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
        for ($i=0; $i < 10; $i++) {
            $cats = [];
            $parentCategory = Category::where('id', '<=', 5)->inRandomOrder()->take(1)->get()[0];
            $cats[] = $parentCategory;
            $subcats = Category::find($parentCategory->id)->subcats;
            $subcats = $subcats->random(rand(1,$subcats->count()));
            $cats[] = $subcats;
            Post::factory()
                ->count(1)
                ->hasAttached([...$cats])
                ->create();
        }
    }
}
