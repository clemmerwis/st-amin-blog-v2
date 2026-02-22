<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test to verify the application responds.
     *
     * The root route (/) redirects to /home.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertRedirect(route('home'));
    }
}
