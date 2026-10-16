@extends('layouts.app')

@section('content')
    <div class="page-content">
        <x-page-heading
            :title="($rotated ?? false) ? 'Secreto regenerado' : 'Aplicación creada'"
            :description="$application->name"
            :back-url="route('dashboard', ['tab' => 'applications'])"
            back-label="Volver a aplicaciones"
        />

        <section class="detail-card" aria-label="Credenciales OAuth">
            @if ($rotated ?? false)
                <p class="credential-intro">
                    Se generó un nuevo secreto para <strong>{{ $application->name }}</strong>. El Client ID no cambió.
                </p>
            @else
                <p class="credential-intro">
                    <strong>{{ $application->name }}</strong> fue registrada correctamente y tiene un cliente OAuth asociado.
                </p>
            @endif

            <div class="notice notice-warning" role="alert">
                <strong>Importante:</strong> copiá y guardá el Client Secret en un gestor seguro ahora. No volverá a mostrarse y no podremos recuperarlo del hash almacenado.
            </div>

            <div class="credential-list">
                <div>
                    <span class="detail-label">Client ID</span>
                    <div class="credential-row">
                        <input class="form-control form-value--mono" id="client_id" value="{{ $clientId }}" readonly>
                        <button class="button button-secondary button-copy" type="button" data-copy-target="client_id" data-copy-label="Copiar" data-copy-feedback="client-id-feedback">Copiar</button>
                    </div>
                    <p class="copy-feedback" id="client-id-feedback" role="status" aria-live="polite"></p>
                </div>

                <div>
                    <span class="detail-label">Client Secret</span>
                    <div class="credential-row">
                        <input class="form-control form-value--mono" id="client_secret" value="{{ $clientSecret }}" readonly>
                        <button class="button button-secondary button-copy" type="button" data-copy-target="client_secret" data-copy-label="Copiar" data-copy-feedback="client-secret-feedback">Copiar</button>
                    </div>
                    <p class="copy-feedback" id="client-secret-feedback" role="status" aria-live="polite"></p>
                    <p class="field-hint">Tipo de autenticación: client_credentials.</p>
                </div>
            </div>

            <div class="page-actions">
                <a class="button button-primary" href="{{ route('dashboard', ['tab' => 'applications']) }}">Volver a aplicaciones</a>
            </div>
        </section>
    </div>
@endsection
