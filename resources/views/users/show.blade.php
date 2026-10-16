@extends('layouts.app')

@section('content')
    <div class="page-content page-content--wide">
        <x-page-heading
            :title="$user->name"
            description="Información del usuario y sus tokens asociados."
            :back-url="route('dashboard', ['tab' => 'users'])"
            back-label="Volver a usuarios"
        />

        <section class="detail-card" aria-label="Información del usuario">
            <div class="detail-grid">
                <div>
                    <span class="detail-label">Nombre</span>
                    <div class="detail-value">{{ $user->name }}</div>
                </div>
                <div>
                    <span class="detail-label">Email</span>
                    <div class="detail-value">{{ $user->email }}</div>
                </div>
                <div>
                    <span class="detail-label">Tokens</span>
                    <div class="detail-value">{{ $tokens->count() }}</div>
                </div>
            </div>
        </section>

        <section class="table-card user-token-card">
            <div class="table-header">
                <div>
                    <h2>Tokens</h2>
                    <span>{{ $tokens->count() }} registros</span>
                </div>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Duración</th>
                            <th>Creado</th>
                            <th>Vence</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tokens as $token)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $token->name }}</td>
                                <td>{{ $token->token_type_name ?? 'Sin tipo' }}</td>
                                <td>{{ $token->expires_in ?? '—' }}</td>
                                <td>{{ \Carbon\Carbon::parse($token->created_at)->format('d/m/Y H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($token->expires_at)->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if ($token->revoked)
                                        <span class="status status-revoked">Revocado</span>
                                    @elseif ($token->expires_at && \Carbon\Carbon::parse($token->expires_at)->isPast())
                                        <span class="status status-expired">Expirado</span>
                                    @else
                                        <span class="status status-active">Activo</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty">Este usuario todavía no tiene tokens.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
