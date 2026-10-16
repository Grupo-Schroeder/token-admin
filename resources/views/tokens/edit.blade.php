@extends('layouts.app')

@section('content')
    <div class="page-content">
        <x-page-heading
            title="Cambiar token"
            description="Modificá la configuración de expiración. El access token no cambiará."
            :back-url="route('tokens.show', $token->id)"
            back-label="Volver al token"
        />

        @if (session('error'))
            <div class="notice notice-warning" role="alert">{{ session('error') }}</div>
        @endif

        <section class="form-card" aria-label="Configuración del token">
            <div class="detail-grid form-grid">
                <div class="form-field">
                    <span class="detail-label">ID</span>
                    <div class="form-value form-value--mono">{{ $token->id }}</div>
                </div>
                <div class="form-field">
                    <span class="detail-label">Nombre</span>
                    <div class="form-value">{{ $token->name }}</div>
                </div>
                <div class="form-field">
                    <span class="detail-label">Usuario</span>
                    <div class="form-value">{{ $token->user_name ?? '—' }}</div>
                </div>
                <div class="form-field">
                    <span class="detail-label">Email</span>
                    <div class="form-value">{{ $token->user_email ?? '—' }}</div>
                </div>
                <div class="form-field">
                    <span class="detail-label">Tipo de token</span>
                    <div class="form-value">{{ $token->token_type_name ?? '—' }}</div>
                </div>
                <div class="form-field">
                    <span class="detail-label">Estado</span>
                    <div class="form-value">
                        @if ($token->revoked)
                            <span class="status status-revoked">Revocado</span>
                        @elseif ($token->expires_at && \Carbon\Carbon::parse($token->expires_at)->isPast())
                            <span class="status status-expired">Expirado</span>
                        @else
                            <span class="status status-active">Activo</span>
                        @endif
                    </div>
                </div>
                <div class="form-field">
                    <span class="detail-label">Creado</span>
                    <div class="form-value">{{ \Carbon\Carbon::parse($token->created_at)->format('d/m/Y H:i') }}</div>
                </div>
                <div class="form-field">
                    <span class="detail-label">Vencimiento actual</span>
                    <div class="form-value">{{ \Carbon\Carbon::parse($token->expires_at)->format('d/m/Y H:i') }}</div>
                </div>
            </div>

            <div class="notice notice-warning">
                Al guardar, se actualizará la fecha de vencimiento del token. El access token no se modifica.
            </div>

            <form action="{{ route('tokens.update', $token->id) }}" method="POST">
                @csrf
                @method('PUT')

                <x-form-field name="expires_in" label="Nueva duración" required class="form-field--full">
                    <select class="form-control" name="expires_in" id="expires_in" required>
                        <option value="15m" @selected(old('expires_in', $token->expires_in) === '15m')>15 minutos</option>
                        <option value="30m" @selected(old('expires_in', $token->expires_in) === '30m')>30 minutos</option>
                        <option value="1h" @selected(old('expires_in', $token->expires_in) === '1h')>1 hora</option>
                        <option value="5h" @selected(old('expires_in', $token->expires_in) === '5h')>5 horas</option>
                        <option value="1d" @selected(old('expires_in', $token->expires_in) === '1d')>1 día</option>
                        <option value="5d" @selected(old('expires_in', $token->expires_in) === '5d')>5 días</option>
                        <option value="20d" @selected(old('expires_in', $token->expires_in) === '20d')>20 días</option>
                        <option value="1M" @selected(old('expires_in', $token->expires_in) === '1M')>1 mes</option>
                        <option value="1y" @selected(old('expires_in', $token->expires_in) === '1y')>1 año</option>
                    </select>
                </x-form-field>

                <div class="form-actions">
                    <button class="button button-primary" type="submit">Guardar cambios</button>
                    <a class="button button-secondary" href="{{ route('tokens.show', $token->id) }}">Cancelar</a>
                </div>
            </form>
        </section>
    </div>
@endsection
