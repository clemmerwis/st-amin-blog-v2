<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test isAdminMiddleware allows admin users.
     *
     * Note: /admin/dashboard redirects to admin.posts.index (302), so
     * a successful admin request still produces a redirect response.
     */
    public function test_is_admin_middleware_allows_admin()
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        // Admin passes the isAdmin middleware; dashboard redirects to posts index
        $response->assertRedirect(route('admin.posts.index'));
    }

    /**
     * Test isAdminMiddleware blocks regular users.
     */
    public function test_is_admin_middleware_blocks_regular_user()
    {
        $user = User::factory()->create(['is_admin' => 0]);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('not_admin');
    }

    /**
     * Test isAdminMiddleware blocks guests.
     *
     * Note: isAdmin middleware runs before auth middleware on admin routes,
     * so guests are redirected to home (not login) with 'not_admin' session key.
     */
    public function test_is_admin_middleware_blocks_guest()
    {
        $response = $this->get('/admin/dashboard');

        // isAdmin middleware redirects unauthenticated users to home
        $response->assertRedirect(route('home'));
    }

    /**
     * Test isUserMiddleware allows regular users.
     */
    public function test_is_user_middleware_allows_regular_user()
    {
        $user = User::factory()->create(['is_admin' => 0]);

        // /user/profile is protected by isUser middleware
        $response = $this->actingAs($user)->get('/user/profile');

        // Regular users pass the isUser middleware (200 from profile view)
        $response->assertStatus(200);
    }

    /**
     * Test isUserMiddleware blocks admin users.
     */
    public function test_is_user_middleware_blocks_admin()
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get('/user/profile');

        // Admin is redirected away from user routes
        $response->assertRedirect(route('home'));
        $response->assertSessionHas('not_user');
    }

    /**
     * Test isUserMiddleware blocks guests.
     */
    public function test_is_user_middleware_blocks_guest()
    {
        $response = $this->get('/user/profile');

        // isUser middleware redirects unauthenticated users to home
        $response->assertRedirect(route('home'));
    }
}
