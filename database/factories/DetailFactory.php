<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Detail;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailFactory extends Factory
{
    protected $model = Detail::class;

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
