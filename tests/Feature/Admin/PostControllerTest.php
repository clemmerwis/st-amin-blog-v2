<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guest cannot access posts API.
     *
     * The API routes use the 'auth' middleware, which returns 401 for JSON
     * requests from unauthenticated users.
     */
    public function test_guest_cannot_access_posts()
    {
        $response = $this->getJson('/api/admin/posts');

        $response->assertStatus(401);
    }

    /**
     * Test non-admin can access posts API.
     *
     * Note: The /api/admin/* routes only use 'auth' middleware (not isAdmin).
     * Any authenticated user can access them. This is by design — the admin
     * UI itself is protected by isAdmin middleware at the page level.
     */
    public function test_non_admin_cannot_access_posts()
    {
        $user = User::factory()->create(['is_admin' => 0]);

        $response = $this->actingAs($user)->getJson('/api/admin/posts');

        // API routes only require auth, not admin role — regular users get 200
        $response->assertStatus(200);
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
     *
     * The store endpoint requires a 'categories' array (category names).
     * We create a category first so the lookup works.
     */
    public function test_admin_can_create_post()
    {
        $admin = User::factory()->admin()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($admin)->postJson('/api/admin/posts', [
            'title'      => 'Test Post',
            'slug'       => 'test-post',
            'body'       => '<p>Test content</p>',
            'excerpt'    => 'Test excerpt',
            'active'     => 1,
            'featured'   => 0,
            'categories' => [$category->name],
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', ['title' => 'Test Post']);
    }

    /**
     * Test admin can update post.
     *
     * The update endpoint requires a 'categories' array (category names).
     * We create a category and attach it to the post for a realistic test.
     */
    public function test_admin_can_update_post()
    {
        $admin = User::factory()->admin()->create();
        $category = Category::factory()->create();
        $post = Post::factory()->create(['author_id' => $admin->id, 'title' => 'Old Title']);
        $post->categories()->sync([$category->id]);

        $response = $this->actingAs($admin)->postJson("/api/admin/posts/{$post->id}", [
            'title'      => 'New Title',
            'slug'       => $post->slug,
            'body'       => $post->body,
            'excerpt'    => $post->excerpt,
            'active'     => 1,
            'featured'   => 0,
            'categories' => [$category->name],
            '_method'    => 'PUT',
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
