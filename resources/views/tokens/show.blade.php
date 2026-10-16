@extends('layouts.app')

@section('content')
    <div class="page-content">
        <x-page-heading
            title="Detalle del token"
            :description="$token->name"
            :back-url="route('dashboard', ['tab' => 'tokens'])"
            back-label="Volver a tokens"
        />

        <section class="detail-card" aria-label="Información del token">
            <div class="detail-grid">
                <div>
                    <span class="detail-label">ID</span>
                    <div class="detail-value form-value form-value--mono">{{ $token->id }}</div>
                </div>
                <div>
                    <span class="detail-label">Nombre</span>
                    <div class="detail-value">{{ $token->name }}</div>
                </div>
                <div>
                    <span class="detail-label">Usuario</span>
                    <div class="detail-value">{{ $token->user_name ?? '—' }}</div>
                </div>
                <div>
                    <span class="detail-label">Email</span>
                    <div class="detail-value">{{ $token->user_email ?? '—' }}</div>
                </div>
                <div>
                    <span class="detail-label">Tipo de token</span>
                    <div class="detail-value">{{ $token->token_type_name ?? '—' }}</div>
                </div>
                <div>
                    <span class="detail-label">Duración</span>
                    <div class="detail-value">{{ $token->expires_in ?? '—' }}</div>
                </div>
                <div>
                    <span class="detail-label">Creado</span>
                    <div class="detail-value">{{ $token->created_at ?? '—' }}</div>
                </div>
                <div>
                    <span class="detail-label">Expira</span>
                    <div class="detail-value">{{ $token->expires_at ?? '—' }}</div>
                </div>
                <div>
                    <span class="detail-label">Estado</span>
                    <div class="detail-value">
                        @if ($token->revoked)
                            <span class="status status-revoked">Revocado</span>
                        @elseif ($token->expires_at && \Carbon\Carbon::parse($token->expires_at)->isPast())
                            <span class="status status-expired">Expirado</span>
                        @else
                            <span class="status status-active">Activo</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="page-actions">
                <a class="button button-secondary" href="{{ route('dashboard', ['tab' => 'tokens']) }}">Volver a tokens</a>
            </div>
        </section>
    </div>
@endsection
