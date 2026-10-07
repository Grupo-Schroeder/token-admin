<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Token Admin</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        /* =========================
           TOPBAR
        ========================= */

        .topbar {
            height: 64px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;

            display: flex;
            align-items: center;

            padding: 0 32px;

            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;

            font-size: 15px;
            font-weight: 700;

            min-width: 200px;
        }

        .brand-mark {
            width: 32px;
            height: 32px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 8px;

            background: #6366f1;
            color: white;

            font-size: 14px;
            font-weight: 700;
        }

        .topbar-nav {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .topbar-link {
            position: relative;

            padding: 22px 14px;

            color: #6b7280;
            text-decoration: none;

            font-size: 13px;
            font-weight: 500;

            transition: color 0.15s ease;
        }

        .topbar-link:hover {
            color: #111827;
        }

        .topbar-link.active {
            color: #111827;
        }

        .topbar-link.active::after {
            content: "";

            position: absolute;
            bottom: 0;
            left: 14px;
            right: 14px;

            height: 2px;

            background: #6366f1;
            border-radius: 2px;
        }

        .topbar-user {
            margin-left: auto;

            display: flex;
            align-items: center;
            gap: 9px;

            padding-left: 20px;
        }

        .avatar {
            width: 32px;
            height: 32px;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #eef2ff;
            color: #4f46e5;

            font-size: 12px;
            font-weight: 600;
        }

        .user-details {
            display: flex;
            flex-direction: column;
            gap: 1px;
        }

        .user-name {
            font-size: 12px;
            font-weight: 600;
            color: #111827;
        }

        .user-role {
            font-size: 10px;
            color: #9ca3af;
        }

        .user-chevron {
            margin-left: 4px;

            color: #9ca3af;
            font-size: 15px;
        }

        /* =========================
           MAIN
        ========================= */

        .main {
            max-width: 1400px;
            margin: 0 auto;
            padding: 32px;
        }

        .header {
            margin-bottom: 28px;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .header p {
            margin-top: 6px;
            color: #6b7280;
            font-size: 14px;
        }

        .new-token-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 9px 14px;

            border-radius: 6px;

            background: #6366f1;
            color: white;

            text-decoration: none;

            font-size: 12px;
            font-weight: 600;

            transition: all 0.15s ease;
        }

        .new-token-button:hover {
            background: #4f46e5;
        }

        /* =========================
           STATS
        ========================= */

        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 22px;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .card-label {
            color: #6b7280;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .card-value {
            font-size: 30px;
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        /* =========================
           TABLE
        ========================= */

        .table-card {
            background: #ffffff;

            border: 1px solid #e5e7eb;
            border-radius: 12px;

            overflow-x: auto;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 20px 22px;

            border-bottom: 1px solid #e5e7eb;
        }

        .table-header h2 {
            font-size: 17px;
            font-weight: 600;
        }

        .table-header span {
            display: block;

            margin-top: 4px;

            color: #9ca3af;
            font-size: 12px;
        }

        table {
            width: 100%;
            min-width: 1000px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px 22px;
            text-align: left;
            border-bottom: 1px solid #f1f3f5;
        }

        th {
            background: #fafafa;

            color: #6b7280;

            font-size: 11px;
            font-weight: 600;

            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            font-size: 14px;
            color: #374151;
        }

        tbody tr {
            transition: background 0.15s ease;
        }

        tbody tr:hover {
            background: #fafafa;
        }

        tr:last-child td {
            border-bottom: none;
        }

        /* =========================
           TOKEN ID
        ========================= */

        .token-id {
            display: inline-block;

            max-width: 130px;

            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;

            padding: 5px 8px;

            border-radius: 6px;

            background: #f3f4f6;

            color: #6b7280;

            font-family: monospace;
            font-size: 11px;
        }

        /* =========================
           USER ID
        ========================= */

        .user-id {
            display: inline-flex;

            padding: 5px 8px;

            border-radius: 6px;

            background: #f3f4f6;

            color: #374151;

            font-family: monospace;
            font-size: 12px;
        }

        /* =========================
           STATUS
        ========================= */

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 5px 9px;

            border-radius: 999px;

            font-size: 11px;
            font-weight: 600;
        }

        .status::before {
            content: "";

            width: 6px;
            height: 6px;

            border-radius: 50%;
        }

        .status-active {
            background: #ecfdf5;
            color: #047857;
        }

        .status-active::before {
            background: #10b981;
        }

        .status-expired {
            background: #fffbeb;
            color: #b45309;
        }

        .status-expired::before {
            background: #f59e0b;
        }

        .status-revoked {
            background: #fef2f2;
            color: #b91c1c;
        }

        .status-revoked::before {
            background: #ef4444;
        }

        /* =========================
           EMPTY STATE
        ========================= */

        .empty {
            padding: 40px 20px;

            text-align: center;

            color: #9ca3af;

            font-size: 14px;
        }

        /* =========================
           ACTION
        ========================= */

        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 6px 10px;

            border: 1px solid #fecaca;
            border-radius: 6px;

            background: #fff;
            color: #dc2626;

            font-size: 12px;
            font-weight: 600;

            cursor: pointer;

            transition: all 0.15s ease;
        }

        .action-button:hover {
            background: #fef2f2;
            border-color: #fca5a5;
        }

        .action-button:active {
            background: #fee2e2;
        }

        /* =========================
           REFRESH / FILTER BUTTON
        ========================= */

        .refresh-button {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 7px 11px;

            border: 1px solid #e5e7eb;
            border-radius: 6px;

            background: #ffffff;
            color: #374151;

            font-size: 12px;
            font-weight: 600;

            cursor: pointer;
            text-decoration: none;

            transition: all 0.15s ease;
        }

        .refresh-button:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        /* =========================
           FILTER
        ========================= */

        .table-filters {
            display: flex;
            flex-wrap: wrap;
            align-items: center;

            gap: 12px;

            padding: 12px 22px;

            border-bottom: 1px solid #e5e7eb;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .filter-label {
            color: #6b7280;
            font-size: 12px;
            font-weight: 500;
            white-space: nowrap;
        }

        .filter-select,
        .filter-input {
            height: 32px;

            padding: 0 9px;

            border: 1px solid #e5e7eb;
            border-radius: 6px;

            background: #ffffff;
            color: #374151;

            font-family: inherit;
            font-size: 12px;
            font-weight: 500;

            transition: all 0.15s ease;
        }

        .filter-select {
            cursor: pointer;
        }

        .filter-input::placeholder {
            color: #9ca3af;
        }

        .filter-select:hover,
        .filter-input:hover {
            border-color: #d1d5db;
        }

        .filter-select:focus,
        .filter-input:focus {
            outline: none;
            border-color: #6366f1;
        }

        /* =========================
           PAGINATION
        ========================= */

        .pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 16px 22px;

            border-top: 1px solid #e5e7eb;
        }

        .pagination-info {
            color: #6b7280;
            font-size: 12px;
        }

        .pagination-links {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .pagination-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 32px;
            height: 32px;

            padding: 0 9px;

            border: 1px solid #e5e7eb;
            border-radius: 6px;

            background: #ffffff;
            color: #374151;

            font-size: 12px;
            font-weight: 500;

            text-decoration: none;

            transition: all 0.15s ease;
        }

        .pagination-button:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .pagination-button.active {
            background: #6366f1;
            border-color: #6366f1;
            color: #ffffff;
        }

        .pagination-button.disabled {
            color: #d1d5db;
            background: #f9fafb;
            cursor: not-allowed;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 800px) {

            .topbar {
                padding: 0 16px;
            }

            .topbar-brand {
                min-width: auto;
            }

            .topbar-nav {
                display: none;
            }

            .user-details,
            .user-chevron {
                display: none;
            }

            .main {
                padding: 20px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .header-content {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <!-- =========================
         TOP MENU
    ========================== -->

    <header class="topbar">

        <div class="topbar-brand">

            <div class="brand-mark">
                T
            </div>

            <span>
                Token Admin
            </span>

        </div>

        <div class="topbar-user">

            <div class="avatar">
                U
            </div>

            <div class="user-details">

                <span class="user-name">
                    Usuario
                </span>

                <span class="user-role">
                    Administrador
                </span>

            </div>

            <span class="user-chevron">
                ⌄
            </span>

        </div>

    </header>


    <!-- =========================
         MAIN
    ========================== -->

    <main class="main">

        <header class="header">

            <div class="header-content">

                <div>

                    <h1>
                        Dashboard
                    </h1>

                    <p>
                        Resumen de los tokens generados por la aplicación.
                    </p>

                </div>

                <a href="{{ route('tokens.create') }}" class="new-token-button">
                    + Nuevo token
                </a>

            </div>

        </header>


        <!-- =========================
             STATISTICS
        ========================== -->

        <section class="stats">

            <div class="card">

                <div class="card-label">
                    Total de tokens
                </div>

                <div class="card-value">
                    {{ $total }}
                </div>

            </div>

        </section>


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

            </div>


            <form method="GET" action="{{ url('/dashboard') }}" class="table-filters">

                <div class="filter-group">

                    <label for="status" class="filter-label">
                        Estado
                    </label>

                    <select
                        name="status"
                        id="status"
                        class="filter-select"
                        onchange="this.form.submit()"
                    >
                        <option value="all" @selected($status === 'all')>
                            Todos
                        </option>

                        <option value="active" @selected($status === 'active')>
                            Activo
                        </option>

                        <option value="expired" @selected($status === 'expired')>
                            Expirado
                        </option>

                        <option value="revoked" @selected($status === 'revoked')>
                            Revocado
                        </option>
                    </select>

                </div>


                <div class="filter-group">

                    <label for="email" class="filter-label">
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

                    <label for="name" class="filter-label">
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

                    <label for="created_from" class="filter-label">
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

                    <label for="expires_from" class="filter-label">
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


                <button type="submit" class="refresh-button">
                    Filtrar
                </button>

            </form>


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
                            EMAIL
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

                    @forelse ($data as $token)

                        <tr>

                            <!-- ID -->

                            <td>

                                <span class="token-id">
                                    {{ $data->firstItem() + $loop->index }}
                                </span>

                            </td>


                            <!-- USER ID -->

                            <td>

                                <span class="user-id">
                                    {{ $token->user_id }}
                                </span>

                            </td>


                            <!-- USER EMAIL -->

                            <td>

                                <span class="user-id">
                                    {{ $token->email }}
                                </span>

                            </td>


                            <!-- NAME -->

                            <td>
                                {{ $token->name }}
                            </td>


                            <!-- TOKEN TYPE -->

                            <td>
                                {{ $token->token_type_name ?? 'Sin tipo' }}
                            </td>

                            <!-- DURARTIONS -->
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
                                {{ $token->created_at }}
                            </td>


                            <!-- EXPIRES -->

                            <td>
                                {{ $token->expires_at }}
                            </td>


                            <!-- STATUS -->

                            <td>

                                @if ($token->revoked)

                                    <span class="status status-revoked">
                                        Revocado
                                    </span>

                                @elseif (\Carbon\Carbon::parse($token->expires_at)->isPast())

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

                                <form
                                    action="{{ url('/token/' . $token->id . '/revoke') }}"
                                    method="POST"
                                >

                                    @csrf

                                    <button type="submit" class="action-button">
                                        Revocar
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9">

                                <div class="empty">
                                    No hay tokens registrados.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>


            @if ($data->total() > 0)

                <div class="pagination">

                    <div class="pagination-info">

                        Mostrando
                        {{ $data->firstItem() }}
                        -
                        {{ $data->lastItem() }}
                        de
                        {{ $data->total() }}

                    </div>


                    <div class="pagination-links">

                        @if ($data->onFirstPage())

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


                        @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)

                            @if ($page === $data->currentPage())

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


                        @if ($data->hasMorePages())

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

    </main>

</body>

</html>
