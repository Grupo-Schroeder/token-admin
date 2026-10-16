<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_log_out_and_session_is_invalidated(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->withSession(['dashboard-state' => 'sensitive'])
            ->post(route('logout'))
            ->assertRedirectToRoute('login')
            ->assertSessionMissing('dashboard-state');

        $this->assertGuest('web');
    }

    public function test_guest_is_redirected_to_login_when_posting_logout(): void
    {
        $this->post(route('logout'))
            ->assertRedirectToRoute('login');
    }
}
