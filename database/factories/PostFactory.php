<?php

namespace Database\Factories;

use App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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

        // wrap content in html p tags
        $body = collect($this->faker->paragraphs(rand(5, 15)))
            ->map(function ($item) {
                return "<p>$item</p>";
            })->toArray();
        $body = implode($body);

        return [
            'author_id' => 1,
            'title' => $title,
            'slug' => $slug,

            'body' => $body,

            'excerpt' => $this->faker->text($this->faker->numberBetween(200, 300)),
        ];
    }
}