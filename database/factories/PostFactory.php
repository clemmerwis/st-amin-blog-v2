<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Detail;
use App\Models\Category;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;


class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $body = collect($this->faker->paragraphs(rand(5, 15)))
        ->map(function($item){
            return "<p>$item</p>";
        })->toArray();
        $body = implode($body);

        $title = $this->faker->sentence;
        $slug = Str::slug($title);

        $date = $this->faker->dateTimeBetween('-1 day' );

        return [
            'author_id' => 1,
            'title' => $title,
            'slug' => $slug,
            // 'body' => $this->faker->paragraph(30),
            'body' => $body,
            'image_path' => 'img/categories-grid/cg-1.jpg',
            'excerpt' => $this->faker->text($this->faker->numberBetween(200, 300)),
            'published_at' => $date,
            'created_at'=> $date,
            'updated_at'=> $date,
        ];
    }
}
