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
            $cat = Category::inRandomOrder()->take(rand(1, 3))->get();
            Post::factory()
                ->count(1)
                ->hasAttached([...$cat])
                ->create();
        }
    }
}
