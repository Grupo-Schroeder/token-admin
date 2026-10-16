@extends('layouts.app')

@section('content')
    <div class="page-content">
        <x-page-heading
            title="Token creado"
            description="El token se muestra completo una sola vez. Guardalo en un lugar seguro."
            :back-url="route('dashboard', ['tab' => 'tokens'])"
            back-label="Volver a tokens"
        />

        <section class="detail-card" aria-label="Access token generado">
            <div class="notice notice-warning" role="alert">
                <strong>Importante:</strong> copiá y guardá este token ahora. No vas a poder recuperarlo después.
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
                <div>
                    <span class="detail-label">Vigencia</span>
                    <div class="detail-value">{{ $expiresIn ?? '—' }}</div>
                </div>
                <div>
                    <span class="detail-label">Expira</span>
                    <div class="detail-value">{{ $expiresAt?->format('d/m/Y H:i') ?? '—' }}</div>
                </div>
            </div>

            <div class="credential-list credential-list--token">
                <div>
                    <span class="detail-label">Access token</span>
                    <div class="credential-row">
                        <code class="secret-value" id="access-token">{{ $token }}</code>
                        <button
                            class="button button-secondary button-copy"
                            type="button"
                            data-copy-target="access-token"
                            data-copy-label="Copiar"
                            data-copy-feedback="access-token-feedback"
                            aria-label="Copiar access token"
                        >Copiar</button>
                    </div>
                    <p class="copy-feedback" id="access-token-feedback" role="status" aria-live="polite"></p>
                </div>
            </div>

            <div class="page-actions">
                <a class="button button-primary" href="{{ route('dashboard', ['tab' => 'tokens']) }}">Volver a tokens</a>
            </div>
        </section>
    </div>
@endsection
