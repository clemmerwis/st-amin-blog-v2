<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


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
        $title = $this->faker->sentence;
        $slug = Str::slug($title);
        $date = $this->faker->dateTimeBetween('-1 day' );
        return [
            'author_id' => 1,
            'title' => $title,
            'slug' => $slug,
            'body' => $this->faker->paragraph(30),
            'image_path' => 'img/categories-grid/cg-10.jpg',
            'excerpt' => $this->faker->text($this->faker->numberBetween(200, 300)),
            'published_at' => $date,
            'category_id' => $this->faker->numberBetween(1, 10),
            'created_at'=> $date,
            'updated_at'=> $date,
        ];
    }
}
