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
        for ($i=1; $i <= 6; $i++) {
            // $chapterCategory = Category::firstOrCreate(['name' => "Chapter $i"]);
            $chapterCategory = Category::where('name', "Chapter $i")->firstOrFail();

            $post = Post::factory()->create();
            $post->categories()->attach([$chapterCategory->id, 3]);
            $post->detail()->save(Detail::factory()->make());
        }

        $requiredCategoryIds = [1, 2, 4, 5];
        shuffle($requiredCategoryIds);
        
        for ($i=1; $i <= 15; $i++) {
            $cats = [];
            // get parent category but not 3, because 3 = stories of mirrors
            if ($i <= 4) {
                // Ensure we get each category for the first 4 iterations
                $parentCategory = Category::findOrFail($requiredCategoryIds[$i - 1]);
            } else {
                // Randomly select a category for the remaining iterations
                $parentCategory = Category::whereIn('id', [1, 2, 4, 5])
                    ->inRandomOrder()
                    ->first();
            }
            
            $cats[] = $parentCategory;
            // get parent category's subcategories
            $subcats = Category::find($parentCategory->id)->subcats;

            $subcats = $subcats->random(rand(1,$subcats->count()));
    
            

            $cats[] = $subcats;

            $posts = Post::factory()
                ->count(1)
                ->hasAttached([...$cats])
                ->create();

            foreach ($posts as $p) {
                $p->detail()->save(Detail::factory()->make());
            }
        }
    }
}