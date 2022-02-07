<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Detail;

class DetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // impliment later
        $template_options = ['default', 'gallery', 'review'];
        $random_index = rand(0, 2);
        $template_name = $template_options[$random_index];
        return [
            'template_name' => 'default'
        ];
    }
}
