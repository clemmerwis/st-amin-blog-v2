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
        Category::factory()->create([
            'name' => 'Ghost Stories',
            'slug' => 'ghost-stories',
        ]);
        Category::factory()->create([
            'name' => 'Art Gallery',
            'slug' => 'art-gallery',
        ]);
        Category::factory()->create([
            'name' => 'Stories of Mirrors',
            'slug' => 'stories-of-mirrors',
        ]);
        Category::factory()->create([
            'name' => 'Health & Wellness',
            'slug' => 'health-and-wellness',
        ]);
        Category::factory()->create([
            'name' => 'Magick',
            'slug' => 'magick',
        ]);
        Category::factory()->create([
            'name' => 'User Submitted',
            'slug' => 'user-submitted',
            'parent_id' => 1,
        ]);

        $chapters = [
            'one' => 'Chapter 1',
            'two' => 'Chapter 2',
            'three' => 'Chapter 3',
            'four' => 'Chapter 4',
            'five' => 'Chapter 5',
            'six' => 'Chapter 6'
        ];
        
        foreach ($chapters as $slug => $name) {
            Category::factory()->create([
                'name' => $name,
                'slug' => 'chapter-' . $slug,
                'parent_id' => 3,
            ]);
        }
        
        Category::factory()->create([
            'name' => 'Yoga',
            'slug' => 'yoga',
            'parent_id' => 4,
        ]);
        Category::factory()->create([
            'name' => 'Food & Diet',
            'slug' => 'food-and-diet',
            'parent_id' => 4,
        ]);
        Category::factory()->create([
            'name' => 'Protection',
            'slug' => 'protection',
            'parent_id' => 5,
        ]);
        Category::factory()->create([
            'name' => 'Peace',
            'slug' => 'peace',
            'parent_id' => 5,
        ]);
        Category::factory()->create([
            'name' => 'Test',
            'slug' => 'test',
            'parent_id' => 2,
        ]);
    }
}