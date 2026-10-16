<section class="table-card">
    <div class="table-header">
        <div>
            <h2>Aplicaciones</h2>
            <span>
                {{ $applications->total() }} registros
            </span>
        </div>

        <div class="header-actions">
            <a href="{{ route('applications.create') }}" class="primary-button">
                + Nueva aplicación
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Slug</th>
                    <th>Cliente OAuth</th>
                    <th>Estado</th>
                    <th>Creada</th>
                    <th>Acciones</th>
                </tr>
            </thead>
             <tbody>
            @forelse ($applications as $application)
                <tr>
                    <td class="application-name">
                        <strong>{{ $application->name }}</strong>

                        @if ($application->description)
                            <span>{{ $application->description }}</span>
                        @endif
                    </td>

                    <td>
                        <code class="slug">{{ $application->slug }}</code>
                    </td>

                    <td class="oauth-cell">
                        @if ($application->oauth_client_id)
                            <strong>
                                {{ $application->oauth_client_name ?? 'Cliente OAuth' }}
                            </strong>

                            <small>
                                ID: {{ $application->oauth_client_id }}
                            </small>

                            <span class="oauth-status">
                                @if ($application->oauth_client_revoked)
                                    Cliente revocado
                                @else
                                    Cliente activo
                                @endif
                            </span>
                        @else
                            <span class="muted">Sin cliente OAuth</span>
                        @endif
                    </td>

                    <td>
                        <span class="status-pill {{ $application->status === 'active' ? 'status-active' : 'status-inactive' }}">
                            {{ $application->status === 'active' ? 'Activa' : 'Inactiva' }}
                        </span>
                    </td>

                    <td class="date-cell">
                        {{ \Carbon\Carbon::parse($application->created_at)->format('d/m/Y H:i') }}
                    </td>

                    <td>
                        <div class="application-actions">
                            @if (
                                $application->status === 'active'
                                && ! $application->oauth_client_revoked
                                && $application->oauth_client_id
                            )
                                <form
                                    method="POST"
                                    action="{{ route('applications.rotate-secret', $application->id) }}"
                                    data-confirm-title="¿Regenerar el secreto?"
                                    data-confirm-message="Los servicios que usan el secreto anterior deberán actualizar sus credenciales."
                                    data-confirm-label="Regenerar secreto"
                                    data-confirm-tone="warning"
                                >
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Regenerar secreto
                                    </button>
                                </form>

                                <form
                                    method="POST"
                                    action="{{ route('applications.revoke', $application->id) }}"
                                    data-confirm-title="¿Desactivar la aplicación?"
                                    data-confirm-message="Se desactivará esta aplicación y se revocará su cliente OAuth. Los sistemas que dependan de ella dejarán de tener acceso."
                                    data-confirm-label="Desactivar"
                                    data-confirm-tone="danger"
                                >
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Desactivar
                                    </button>
                                </form>
                            @else
                                <span class="muted">
                                    {{ $application->oauth_client_id ? 'Sin acceso' : 'Sin cliente OAuth' }}
                                </span>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-state">
                        No hay aplicaciones registradas.
                    </td>
                </tr>
            @endforelse
        </tbody>

        </table>
    </div>

    <div class="pagination-container">
        {{ $applications->links() }}
    </div>
</section>
