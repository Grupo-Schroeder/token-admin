<!-- =========================
                 TOKENS
            ========================== -->

            <section class="table-card">

                <div class="table-header">

                    <div>
                        <h2>
                            Tokens
                        </h2>

                        <span>
                            {{ $total }} registros
                        </span>
                    </div>

                    <div class="header-actions">

                        <a
                            href="{{ route('tokens.create') }}"
                            class="primary-button"
                        >
                            + Nuevo token
                        </a>

                    </div>

                </div>

                <!-- TOKEN FILTERS -->

                <form
                    method="GET"
                    action="{{ route('dashboard') }}"
                    class="table-filters"
                >

                    <input
                        type="hidden"
                        name="tab"
                        value="tokens"
                    >

                    <div class="filter-group">

                        <label
                            for="status"
                            class="filter-label"
                        >
                            Estado
                        </label>

                        <select
                            name="status"
                            id="status"
                            class="filter-select"
                        >

                            <option
                                value="all"
                                @selected($status === 'all')
                            >
                                Todos
                            </option>

                            <option
                                value="active"
                                @selected($status === 'active')
                            >
                                Activo
                            </option>

                            <option
                                value="expired"
                                @selected($status === 'expired')
                            >
                                Expirado
                            </option>

                            <option
                                value="revoked"
                                @selected($status === 'revoked')
                            >
                                Revocado
                            </option>

                        </select>

                    </div>

                    <div class="filter-group">

                        <label
                            for="email"
                            class="filter-label"
                        >
                            Email
                        </label>

                        <input
                            type="text"
                            id="email"
                            name="email"
                            class="filter-input"
                            placeholder="Buscar email..."
                            value="{{ $email }}"
                        >

                    </div>

                    <div class="filter-group">

                        <label
                            for="name"
                            class="filter-label"
                        >
                            Nombre
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="filter-input"
                            placeholder="Buscar nombre..."
                            value="{{ $name }}"
                        >

                    </div>

                    <div class="filter-group">

                        <label
                            for="created_from"
                            class="filter-label"
                        >
                            Creado desde
                        </label>

                        <input
                            type="date"
                            id="created_from"
                            name="created_from"
                            class="filter-input"
                            value="{{ $createdFrom }}"
                        >

                    </div>

                    <div class="filter-group">

                        <label
                            for="expires_from"
                            class="filter-label"
                        >
                            Vence desde
                        </label>

                        <input
                            type="date"
                            id="expires_from"
                            name="expires_from"
                            class="filter-input"
                            value="{{ $expiresFrom }}"
                        >

                    </div>

                    <button
                        type="submit"
                        class="filter-submit"
                    >
                        Filtrar
                    </button>

                </form>


                <!-- TOKEN TABLE -->

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    #
                                </th>

                                <th>
                                    Usuario
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    Nombre
                                </th>

                                <th>
                                    Tipo
                                </th>

                                <th>
                                    Duración
                                </th>

                                <th>
                                    Creado
                                </th>

                                <th>
                                    Vence
                                </th>

                                <th>
                                    Estado
                                </th>

                                <th>
                                    Acciones
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($data as $token)

                                <tr>

                                    <!-- ROW NUMBER -->

                                    <td>
                                        {{ $data->firstItem() + $loop->index }}
                                    </td>

                                    <!-- USER -->

                                    <td>
                                        {{ $token->user_name ?? $token->user_id }}
                                    </td>

                                    <!-- EMAIL -->

                                    <td>
                                        {{ $token->email }}
                                    </td>

                                    <!-- TOKEN NAME -->

                                    <td>
                                        {{ $token->name }}
                                    </td>

                                    <!-- TOKEN TYPE -->

                                    <td>
                                        {{ $token->token_type_name ?? 'Sin tipo' }}
                                    </td>

                                    <!-- DURATION -->

                                    <td>

                                        @switch($token->expires_in)

                                            @case('15m')
                                                15 minutos
                                                @break

                                            @case('30m')
                                                30 minutos
                                                @break

                                            @case('1h')
                                                1 hora
                                                @break

                                            @case('5h')
                                                5 horas
                                                @break

                                            @case('1d')
                                                1 día
                                                @break

                                            @case('5d')
                                                5 días
                                                @break

                                            @case('20d')
                                                20 días
                                                @break

                                            @case('1M')
                                                1 mes
                                                @break

                                            @case('1y')
                                                1 año
                                                @break

                                            @default
                                                -

                                        @endswitch

                                    </td>

                                    <!-- CREATED -->

                                    <td>
                                        {{ \Carbon\Carbon::parse($token->created_at)->format('d/m/Y H:i') }}
                                    </td>

                                    <!-- EXPIRES -->

                                    <td>
                                        {{ \Carbon\Carbon::parse($token->expires_at)->format('d/m/Y H:i') }}
                                    </td>

                                    <!-- STATUS -->

                                    <td>

                                        @if($token->revoked)

                                            <span class="status status-revoked">
                                                Revocado
                                            </span>

                                        @elseif(\Carbon\Carbon::parse($token->expires_at)->isPast())

                                            <span class="status status-expired">
                                                Expirado
                                            </span>

                                        @else

                                            <span class="status status-active">
                                                Activo
                                            </span>

                                        @endif

                                    </td>

                                    <!-- ACTIONS -->

                                    <td>
                                        <div class="token-actions">

                                            <a
                                                href="{{ route('tokens.show', $token->id) }}"
                                                class="action-link action-view"
                                            >
                                                Ver
                                            </a>

                                            @if(
                                                !$token->revoked &&
                                                !\Carbon\Carbon::parse($token->expires_at)->isPast()
                                            )

                                                <form
                                                    action="{{ url('/token/' . $token->id . '/revoke') }}"
                                                    method="POST"
                                                    data-confirm-title="¿Revocar el token?"
                                                    data-confirm-message="El token dejará de ser válido inmediatamente y las integraciones que lo usan perderán acceso."
                                                    data-confirm-label="Revocar token"
                                                    data-confirm-tone="danger"
                                                >

                                                    @csrf

                                                    <button
                                                        type="submit"
                                                        class="action-revoke"
                                                    >
                                                        Revocar
                                                    </button>

                                                </form>

                                            @else

                                                <span style="color:#9ca3af;">
                                                    —
                                                </span>

                                            @endif

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="10"
                                        class="empty"
                                    >
                                        No hay tokens registrados.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                <!-- TOKEN PAGINATION -->

                @if($data->total() > 0)

                    <div class="pagination">

                        <div class="pagination-info">

                            Mostrando

                            <strong>
                                {{ $data->firstItem() }}
                            </strong>

                            -

                            <strong>
                                {{ $data->lastItem() }}
                            </strong>

                            de

                            <strong>
                                {{ $data->total() }}
                            </strong>

                        </div>

                        <div class="pagination-links">

                            @if($data->onFirstPage())

                                <span class="pagination-button disabled">
                                    ← Anterior
                                </span>

                            @else

                                <a
                                    href="{{ $data->previousPageUrl() }}"
                                    class="pagination-button"
                                >
                                    ← Anterior
                                </a>

                            @endif

                            @foreach(
                                $data->getUrlRange(
                                    1,
                                    $data->lastPage()
                                ) as $page => $url
                            )

                                @if($page == $data->currentPage())

                                    <span class="pagination-button active">
                                        {{ $page }}
                                    </span>

                                @else

                                    <a
                                        href="{{ $url }}"
                                        class="pagination-button"
                                    >
                                        {{ $page }}
                                    </a>

                                @endif

                            @endforeach

                            @if($data->hasMorePages())

                                <a
                                    href="{{ $data->nextPageUrl() }}"
                                    class="pagination-button"
                                >
                                    Siguiente →
                                </a>

                            @else

                                <span class="pagination-button disabled">
                                    Siguiente →
                                </span>

                            @endif

                        </div>

                    </div>

                @endif

            </section>
