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
        Category::factory()->create([
            'name' => 'My Stories',
            'slug' => 'my-stories',
            'parent_id' => 1,
        ]);
        Category::factory()->create([
            'name' => 'Nature',
            'slug' => 'nature',
            'parent_id' => 2,
        ]);
        Category::factory()->create([
            'name' => 'Digital',
            'slug' => 'digital',
            'parent_id' => 2,
        ]);
        Category::factory()->create([
            'name' => 'Chapter 1',
            'slug' => 'chapter-one',
            'parent_id' => 3,
        ]);
        Category::factory()->create([
            'name' => 'Chapter 2',
            'slug' => 'chapter-two',
            'parent_id' => 3,
        ]);
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
    }
}