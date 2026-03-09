<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_alias_redirects_to_admin_login_page(): void
    {
        $response = $this->get('/login');

        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_entry_point_redirects_guests_to_admin_login_page(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect(route('admin.login'));
    }

    public function test_dashboard_alias_redirects_guests_to_admin_login_page(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect(route('admin.login'));
    }

    public function test_dashboard_alias_redirects_admin_users_to_admin_dashboard(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_admin_users_can_login_to_admin_area(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'password',
            'is_admin' => true,
        ]);

        $response = $this->post(route('admin.login.store'), [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);
    }

    public function test_non_admin_users_are_redirected_to_home_when_visiting_dashboard_alias(): void
    {
        $user = User::factory()->create([
            'is_admin' => false,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirect(route('home'));
    }

    public function test_admin_login_is_throttled_after_too_many_failed_attempts(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'password',
            'is_admin' => true,
        ]);

        foreach (range(1, 5) as $attempt) {
            $response = $this->from(route('admin.login'))->post(route('admin.login.store'), [
                'email' => $admin->email,
                'password' => 'wrong-password',
            ]);

            $response->assertRedirect(route('admin.login'));
            $response->assertSessionHasErrors('email');
        }

        $response = $this->from(route('admin.login'))->post(route('admin.login.store'), [
            'email' => $admin->email,
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect(route('admin.login'));
        $response->assertSessionHasErrors([
            'email' => 'Terlalu banyak percobaan login. Silakan coba lagi dalam 60 detik.',
        ]);
        $this->assertGuest();
    }

    public function test_non_admin_users_cannot_access_admin_routes(): void
    {
        $user = User::factory()->create([
            'is_admin' => false,
        ]);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));

        $response->assertForbidden();
    }
}
