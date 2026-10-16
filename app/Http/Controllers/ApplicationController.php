<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Laravel\Passport\ClientRepository;

class ApplicationController extends Controller
{
    public function create(): View
    {
        return view('applications.create');
    }

    public function store(
        Request $request,
        ClientRepository $clients
    ): View {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('applications', 'slug'),
            ],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        $validated['slug'] = Str::slug($validated['slug']);

        [$application, $clientId, $clientSecret] = DB::transaction(
            function () use ($validated, $clients): array {
                $application = Application::create($validated);

                $client = $clients->createClientCredentialsGrantClient(
                    $application->name
                );

                $clientSecret = $client->plainSecret;

                $application->update([
                    'oauth_client_id' => $client->getKey(),
                ]);

                return [
                    $application,
                    $client->getKey(),
                    $clientSecret,
                ];
            }
        );

        return view('applications.credentials', [
            'application' => $application,
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
        ]);
    }

    public function revoke(Application $application, ClientRepository $clients): RedirectResponse
    {
        DB::transaction(function () use ($application, $clients): void {
            $client = $application->oauth_client_id
            ? $clients->find($application->oauth_client_id)
            : null;

            if ($client && ! $client->revoked) {
                // Revoca el cliente y sus tokens asociados.
                $clients->delete($client);
            }

            if ($application->status !== 'inactive') {
                $application->update(['status' => 'inactive']);
            }
        });

        return redirect()
            ->route('dashboard', ['tab' => 'applications'])
            ->with('success', 'Aplicación desactivada y cliente OAuth revocado.');
    }

    public function rotateSecret(Application $application, ClientRepository $clients): View
    {
        abort_unless($application->status === 'active', 403);

        abort_if(! $application->oauth_client_id, 404);

        $client = $clients->find($application->oauth_client_id);

        abort_if(! $client || $client->revoked, 403);

        $clients->regenerateSecret($client);

        // Recuperamos el secreto recién generado en esta instancia.
        $clientSecret = $client->plainSecret;

        return view('applications.credentials', [
            'application' => $application,
            'clientId' => $client->getKey(),
            'clientSecret' => $clientSecret,
            'rotated' => true,
        ]);
    }
}
