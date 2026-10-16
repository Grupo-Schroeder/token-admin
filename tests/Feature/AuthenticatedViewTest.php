<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticatedViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_uses_the_global_title_and_favicon(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('<title>Token Admin | Leben Salud</title>', false)
            ->assertSee('rel="icon"', false)
            ->assertSee('favicon.ico', false);
    }

    public function test_create_token_page_uses_the_shared_authenticated_layout(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('tokens.create'))
            ->assertOk()
            ->assertSee('<title>Token Admin | Leben Salud</title>', false)
            ->assertSee('favicon.ico', false)
            ->assertSee('Leben Salud')
            ->assertSee('Crear token')
            ->assertSee('data-theme-toggle', false)
            ->assertSee('name="user_id"', false)
            ->assertSee('name="expires_in"', false);
    }

    public function test_create_user_page_uses_the_shared_authenticated_layout(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('users.create'))
            ->assertOk()
            ->assertSee('Crear usuario')
            ->assertSee('data-theme-toggle', false)
            ->assertSee('name="token_type_id"', false);
    }

    public function test_create_application_page_uses_the_shared_authenticated_layout(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('applications.create'))
            ->assertOk()
            ->assertSee('Crear aplicación')
            ->assertSee('data-theme-toggle', false)
            ->assertSee('name="slug"', false);
    }
}
