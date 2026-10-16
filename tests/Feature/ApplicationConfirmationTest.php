<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tests\TestCase;

class ApplicationConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_application_actions_render_custom_confirmation_data(): void
    {
        $user = User::factory()->create();
        $clientId = (string) Str::uuid();
        $now = now();

        DB::table('oauth_clients')->insert([
            'id' => $clientId,
            'owner_type' => null,
            'owner_id' => null,
            'name' => 'Test client',
            'secret' => null,
            'provider' => null,
            'redirect_uris' => '[]',
            'grant_types' => '["client_credentials"]',
            'revoked' => false,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('applications')->insert([
            'name' => 'Test application',
            'slug' => 'test-application',
            'description' => null,
            'status' => 'active',
            'oauth_client_id' => $clientId,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $this->actingAs($user)
            ->get(route('dashboard', ['tab' => 'applications']))
            ->assertOk()
            ->assertSee('data-confirm-title="¿Regenerar el secreto?"', false)
            ->assertSee('data-confirm-label="Desactivar"', false)
            ->assertSee('data-confirm-tone="danger"', false)
            ->assertDontSee('onsubmit=', false);
    }
}
