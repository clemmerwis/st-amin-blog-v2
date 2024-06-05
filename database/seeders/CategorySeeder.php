<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the parent category for Stories of Mirrors
        $storiesOfMirrors = Category::factory()->create([
            'name' => 'Stories of Mirrors',
            'slug' => 'stories-of-mirrors',
        ]);

        // Create chapters as child categories of Stories of Mirrors
        $chapters = [
            'one' => 'Chapter 1',
            'two' => 'Chapter 2',
            'three' => 'Chapter 3',
            'four' => 'Chapter 4',
        ];
        
        foreach ($chapters as $slug => $name) {
            Category::factory()->create([
                'name' => $name,
                'slug' => 'chapter-' . $slug,
                'parent_id' => $storiesOfMirrors->id,
            ]);
        }

        // Create the parent category for Magazine
        $magazine = Category::factory()->create([
            'name' => 'Magazine',
            'slug' => 'magazine',
        ]);

        // Optionally, create child categories for Magazine
        $magazineCats = [
            'one' => 'Health & Healing',
            'two' => 'Spells & Energy',
            'three' => 'Tech & Web',
            'four' => 'Useful Apparel',
        ];

        foreach ($magazineCats as $slug => $name) {
            Category::factory()->create([
                'name' => $name,
                'slug' => 'magazine-article-' . $slug,
                'parent_id' => $magazine->id,
            ]);
        }
    }
}