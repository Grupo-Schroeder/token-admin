@extends('layouts.app')

@section('content')
    <div class="page-content">
        <x-page-heading
            title="Usuario creado correctamente"
            :description="'El usuario '.$user->name.' ya está registrado.'"
            :back-url="route('dashboard', ['tab' => 'users'])"
            back-label="Volver a usuarios"
        />

        <section class="detail-card" aria-label="Credenciales generadas">
            <div class="notice notice-success" role="status">
                Las credenciales para acceder a la API fueron generadas correctamente.
            </div>

            <div class="notice notice-warning" role="alert">
                <strong>Importante:</strong> guardá estas credenciales ahora. El Client Secret se muestra solamente en este momento y no podrá recuperarse posteriormente.
            </div>

            <div class="detail-grid">
                <div>
                    <span class="detail-label">Usuario</span>
                    <div class="detail-value">{{ $user->name }} · {{ $user->email }}</div>
                </div>
                <div>
                    <span class="detail-label">Tipo de token</span>
                    <div class="detail-value">{{ $user->tokenType?->name ?? '—' }}</div>
                </div>
            </div>

            <div class="credential-list">
                <div>
                    <span class="detail-label">Client Key</span>
                    <div class="credential-row">
                        <code class="secret-value" id="client_key">{{ $clientKey }}</code>
                        <button class="button button-secondary button-copy" type="button" data-copy-target="client_key" data-copy-label="Copiar" data-copy-feedback="client-key-feedback">Copiar</button>
                    </div>
                    <p class="copy-feedback" id="client-key-feedback" role="status" aria-live="polite"></p>
                </div>

                <div>
                    <span class="detail-label">Client Secret</span>
                    <div class="credential-row">
                        <code class="secret-value" id="client_secret">{{ $clientSecret }}</code>
                        <button class="button button-secondary button-copy" type="button" data-copy-target="client_secret" data-copy-label="Copiar" data-copy-feedback="client-secret-feedback">Copiar</button>
                    </div>
                    <p class="copy-feedback" id="client-secret-feedback" role="status" aria-live="polite"></p>
                </div>
            </div>

            <div class="page-actions">
                <a class="button button-primary" href="{{ route('dashboard', ['tab' => 'users']) }}">Ir a usuarios</a>
                <a class="button button-secondary" href="{{ route('users.create') }}">Crear otro usuario</a>
            </div>
        </section>
    </div>
@endsection
