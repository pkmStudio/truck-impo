<?php

namespace Tests\Feature\Middleware;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectIfAuthenticatedMiddlewareTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testAuthenticatedUserGetsRedirectedToAdmin()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get('/admin/login');
        $response->assertRedirect(route('admin.index'));
    }

    public function testGuestCanAccessLoginPage()
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200); // Ожидаем успешный доступ
    }


}
