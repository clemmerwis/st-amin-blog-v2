<?php

namespace Tests\Feature\Admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guest cannot access posts API.
     */
    public function test_guest_cannot_access_posts()
    {
        $response = $this->getJson('/api/admin/posts');

        $response->assertStatus(401);
    }

    /**
     * Test non-admin cannot access posts API.
     */
    public function test_non_admin_cannot_access_posts()
    {
        $user = User::factory()->create(['is_admin' => 0]);

        $response = $this->actingAs($user)->getJson('/api/admin/posts');

        // Should redirect or return forbidden
        $response->assertStatus(302);
    }

    /**
     * Test admin can list posts.
     */
    public function test_admin_can_list_posts()
    {
        $admin = User::factory()->admin()->create();
        Post::factory()->count(3)->create(['author_id' => $admin->id]);

        $response = $this->actingAs($admin)->getJson('/api/admin/posts');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
    }

    /**
     * Test admin can create post.
     */
    public function test_admin_can_create_post()
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->postJson('/api/admin/posts', [
            'title' => 'Test Post',
            'slug' => 'test-post',
            'body' => '<p>Test content</p>',
            'excerpt' => 'Test excerpt',
            'active' => 1,
            'featured' => 0,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', ['title' => 'Test Post']);
    }

    /**
     * Test admin can update post.
     */
    public function test_admin_can_update_post()
    {
        $admin = User::factory()->admin()->create();
        $post = Post::factory()->create(['author_id' => $admin->id, 'title' => 'Old Title']);

        $response = $this->actingAs($admin)->postJson("/api/admin/posts/{$post->id}", [
            'title' => 'New Title',
            'slug' => $post->slug,
            'body' => $post->body,
            'excerpt' => $post->excerpt,
            'active' => 1,
            'featured' => 0,
            '_method' => 'PUT',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', ['id' => $post->id, 'title' => 'New Title']);
    }

    /**
     * Test admin can delete post.
     */
    public function test_admin_can_delete_post()
    {
        $admin = User::factory()->admin()->create();
        $post = Post::factory()->create(['author_id' => $admin->id]);

        $response = $this->actingAs($admin)->deleteJson("/api/admin/posts/{$post->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
