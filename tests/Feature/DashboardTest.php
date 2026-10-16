<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_renders_brand_controls_and_responsive_dark_styles(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('<title>Token Admin | Leben Salud</title>', false)
            ->assertSee('rel="icon"', false)
            ->assertSee('images/leben-salud-logo.png')
            ->assertSee('.dark .brand-logo', false)
            ->assertSee('border-top: 4px solid #05b8c5', false)
            ->assertSee('data-theme-toggle', false)
            ->assertSee('account-menu', false)
            ->assertSee('data-confirm-dialog', false)
            ->assertSee('Cerrar sesión')
            ->assertSee('.dark body', false)
            ->assertSee('max-width: 520px', false);
    }
}
