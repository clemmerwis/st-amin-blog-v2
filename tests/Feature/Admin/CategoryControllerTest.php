<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guest cannot access categories API.
     */
    public function test_guest_cannot_access_categories()
    {
        $response = $this->getJson('/api/admin/categories');

        $response->assertStatus(401);
    }

    /**
     * Test non-admin cannot access categories API.
     */
    public function test_non_admin_cannot_access_categories()
    {
        $user = User::factory()->create(['is_admin' => 0]);

        $response = $this->actingAs($user)->getJson('/api/admin/categories');

        // Should redirect or return forbidden
        $response->assertStatus(302);
    }

    /**
     * Test admin can list categories.
     */
    public function test_admin_can_list_categories()
    {
        $admin = User::factory()->admin()->create();
        Category::factory()->count(3)->create();

        $response = $this->actingAs($admin)->getJson('/api/admin/categories');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
    }

    /**
     * Test admin can create category.
     */
    public function test_admin_can_create_category()
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->postJson('/api/admin/categories', [
            'name' => 'Test Category',
            'slug' => 'test-category',
        ]);

        $response->assertStatus(201);
        $response->assertJson(['ok' => true]);
        $this->assertDatabaseHas('categories', ['name' => 'Test Category']);
    }

    /**
     * Test admin cannot create duplicate category.
     */
    public function test_admin_cannot_create_duplicate_category()
    {
        $admin = User::factory()->admin()->create();
        Category::factory()->create(['name' => 'Existing', 'slug' => 'existing']);

        $response = $this->actingAs($admin)->postJson('/api/admin/categories', [
            'name' => 'Existing',
            'slug' => 'existing',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'slug']);
    }

    /**
     * Test admin can update category.
     */
    public function test_admin_can_update_category()
    {
        $admin = User::factory()->admin()->create();
        $category = Category::factory()->create(['name' => 'Old Name', 'slug' => 'old-name']);

        $response = $this->actingAs($admin)->putJson("/api/admin/categories/{$category->id}", [
            'name' => 'New Name',
            'slug' => 'new-name',
        ]);

        $response->assertStatus(201);
        $response->assertJson(['ok' => true]);
        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'New Name']);
    }

    /**
     * Test admin can delete category.
     */
    public function test_admin_can_delete_category()
    {
        $admin = User::factory()->admin()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($admin)->deleteJson("/api/admin/categories/{$category->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
