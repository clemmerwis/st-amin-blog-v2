<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Post;

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

        return [
            'author_id' => User::factory(), //Generates a User from factory and extracts id
            'title' => $title, //Generates a fake sentence
            'slug' => $slug,
            'body' => $this->faker->paragraph(30), //generates fake 30 paragraphs
        ];
    }
}
