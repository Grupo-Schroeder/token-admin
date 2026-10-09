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
            margin-bottom: 24px;
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

        /* =========================
           TABS
        ========================= */

        .tabs {
            display: flex;
            align-items: center;

            gap: 4px;

            margin-bottom: 24px;

            border-bottom: 1px solid #e5e7eb;
        }

        .tab {
            position: relative;

            padding: 12px 16px;

            color: #6b7280;

            text-decoration: none;

            font-size: 13px;
            font-weight: 600;

            transition: color 0.15s ease;
        }

        .tab:hover {
            color: #111827;
        }

        .tab.active {
            color: #4f46e5;
        }

        .tab.active::after {
            content: "";

            position: absolute;

            left: 12px;
            right: 12px;
            bottom: -1px;

            height: 2px;

            background: #6366f1;

            border-radius: 2px;
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
           TABLE CARD
        ========================= */

        .table-card {
            background: #ffffff;

            border: 1px solid #e5e7eb;
            border-radius: 12px;

            overflow: hidden;

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

        /* =========================
           ACTIONS
        ========================= */

        .header-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .primary-button {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 8px 12px;

            border: 1px solid #6366f1;
            border-radius: 7px;

            background: #6366f1;
            color: #ffffff;

            font-size: 12px;
            font-weight: 600;

            text-decoration: none;

            transition: all 0.15s ease;
        }

        .primary-button:hover {
            background: #4f46e5;
            border-color: #4f46e5;
        }

        .action-button {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 6px 10px;

            border: 1px solid #fecaca;
            border-radius: 6px;

            background: #ffffff;
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

        .action-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            height: 32px;
            padding: 0 10px;

            border-radius: 6px;

            font-size: 12px;
            font-weight: 600;

            text-decoration: none;

            box-sizing: border-box;

            transition: all 0.15s ease;
        }

        .action-view {
            background: #ffffff;
            color: #374151;
            border: 1px solid #e5e7eb;
        }

        .action-view:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .action-revoke {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            height: 32px;
            padding: 0 10px;

            border: 1px solid #fecaca;
            border-radius: 6px;

            background: #ffffff;
            color: #dc2626;

            font-family: inherit;
            font-size: 12px;
            font-weight: 600;

            cursor: pointer;

            transition: all 0.15s ease;
        }

        .action-revoke:hover {
            background: #fef2f2;
            border-color: #fca5a5;
        }

        .token-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .token-actions form {
            margin: 0;
        }

        .secondary-button {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 6px 10px;

            border: 1px solid #e5e7eb;
            border-radius: 6px;

            background: #ffffff;
            color: #374151;

            font-size: 12px;
            font-weight: 600;

            text-decoration: none;

            transition: all 0.15s ease;
        }

        .secondary-button:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        /* =========================
           FILTERS
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

        .filter-submit {
            height: 32px;

            padding: 0 12px;

            border: 1px solid #e5e7eb;
            border-radius: 6px;

            background: #ffffff;
            color: #374151;

            font-size: 12px;
            font-weight: 600;

            cursor: pointer;
        }

        .filter-submit:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        /* =========================
           TABLE
        ========================= */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;

            border-collapse: collapse;

            min-width: 950px;
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
           LOG STATUS
        ========================= */

        .log-status {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            min-width: 42px;

            padding: 5px 8px;

            border-radius: 6px;

            font-size: 11px;
            font-weight: 700;
        }

        .log-status-success {
            background: #ecfdf5;
            color: #047857;
        }

        .log-status-client-error {
            background: #fffbeb;
            color: #b45309;
        }

        .log-status-server-error {
            background: #fef2f2;
            color: #b91c1c;
        }

        .log-method {
            display: inline-flex;

            padding: 4px 7px;

            border-radius: 5px;

            background: #f3f4f6;

            color: #374151;

            font-family: monospace;
            font-size: 11px;
            font-weight: 600;
        }

        .log-url {
            max-width: 360px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

            font-family: monospace;
            font-size: 12px;
            color: #4b5563;
        }

        .log-token {
            font-weight: 600;
            color: #374151;
        }

        /* =========================
           EMPTY
        ========================= */

        .empty {
            padding: 40px 20px;

            text-align: center;

            color: #9ca3af;

            font-size: 14px;
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
           SUCCESS
        ========================= */

        .success-message {
            margin-bottom: 20px;

            padding: 12px 16px;

            background: #ecfdf5;

            border: 1px solid #a7f3d0;
            border-radius: 8px;

            color: #047857;

            font-size: 13px;
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

            .table-filters {
                align-items: stretch;

                flex-direction: column;
            }

            .filter-group {
                justify-content: space-between;
            }

            .filter-input,
            .filter-select {
                width: 100%;
            }

            .pagination {
                align-items: flex-start;

                flex-direction: column;

                gap: 12px;
            }
        }
    </style>
</head>

<body>

    <!-- =========================
         TOPBAR
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

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @php
            $tab = request()->query('tab', 'tokens');
        @endphp

        <!-- =========================
             TABS
        ========================== -->

        <nav class="tabs">

            <a
                href="{{ route('dashboard', ['tab' => 'tokens']) }}"
                class="tab {{ $tab === 'tokens' ? 'active' : '' }}"
            >
                Tokens
            </a>

            <a
                href="{{ route('dashboard', ['tab' => 'users']) }}"
                class="tab {{ $tab === 'users' ? 'active' : '' }}"
            >
                Usuarios
            </a>

            <a
                href="{{ route('dashboard', ['tab' => 'logs']) }}"
                class="tab {{ $tab === 'logs' ? 'active' : '' }}"
            >
                Logs
            </a>

        </nav>


        @if($tab === 'tokens')

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


        @elseif($tab === 'users')

            <!-- =========================
                 USERS
            ========================== -->

            <section class="table-card">

                <div class="table-header">

                    <div>

                        <h2>
                            Usuarios
                        </h2>

                        <span>
                            {{ $users->total() }} usuarios
                        </span>

                    </div>

                    <div class="header-actions">

                        <a
                            href="{{ route('users.create') }}"
                            class="primary-button"
                        >
                            + Nuevo usuario
                        </a>

                    </div>

                </div>


                <!-- USER SEARCH -->

                <form
                    method="GET"
                    action="{{ route('dashboard') }}"
                    class="table-filters"
                >

                    <input
                        type="hidden"
                        name="tab"
                        value="users"
                    >

                    <div class="filter-group">

                        <label
                            for="user_search"
                            class="filter-label"
                        >
                            Buscar
                        </label>

                        <input
                            type="text"
                            id="user_search"
                            name="user_search"
                            class="filter-input"
                            placeholder="Nombre o email..."
                            value="{{ $userSearch }}"
                        >

                    </div>

                    <button
                        type="submit"
                        class="filter-submit"
                    >
                        Buscar
                    </button>

                </form>


                <!-- USER TABLE -->

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    #
                                </th>

                                <th>
                                    Nombre
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    Tokens
                                </th>

                                <th>
                                    Acciones
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($users as $user)

                                <tr>

                                    <td>
                                        {{ $users->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        {{ $user->name }}
                                    </td>

                                    <td>
                                        {{ $user->email }}
                                    </td>

                                    <td>
                                        {{ $user->tokens_count }}
                                    </td>

                                    <td>

                                        <a
                                            href="{{ route('users.show', $user->id) }}"
                                            class="secondary-button"
                                        >
                                            Ver
                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="5"
                                        class="empty"
                                    >
                                        No hay usuarios registrados.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                <!-- USER PAGINATION -->

                @if($users->total() > 0)

                    <div class="pagination">

                        <div class="pagination-info">

                            Mostrando

                            <strong>
                                {{ $users->firstItem() }}
                            </strong>

                            -

                            <strong>
                                {{ $users->lastItem() }}
                            </strong>

                            de

                            <strong>
                                {{ $users->total() }}
                            </strong>

                        </div>

                        <div class="pagination-links">

                            @if($users->onFirstPage())

                                <span class="pagination-button disabled">
                                    ← Anterior
                                </span>

                            @else

                                <a
                                    href="{{ $users->previousPageUrl() }}"
                                    class="pagination-button"
                                >
                                    ← Anterior
                                </a>

                            @endif

                            @foreach(
                                $users->getUrlRange(
                                    1,
                                    $users->lastPage()
                                ) as $page => $url
                            )

                                @if($page == $users->currentPage())

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

                            @if($users->hasMorePages())

                                <a
                                    href="{{ $users->nextPageUrl() }}"
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


        @elseif($tab === 'logs')

            <!-- =========================
                 LOGS
            ========================== -->

            <section class="table-card">

                <div class="table-header">

                    <div>

                        <h2>
                            Logs
                        </h2>

                        <span>
                            Registro de accesos a la API
                        </span>

                    </div>

                </div>


                <!-- LOG TABLE -->

                <div class="table-wrapper">

                    <table>

                        <thead>

                            <tr>

                                <th>
                                    Fecha
                                </th>

                                <th>
                                    Token
                                </th>

                                <th>
                                    Tipo
                                </th>

                                <th>
                                    Usuario
                                </th>

                                <th>
                                    Método
                                </th>

                                <th>
                                    URL
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    IP
                                </th>

                                <th>
                                    Tiempo
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($logs as $log)

                                <tr>

                                    <td>
                                        {{ $log->created_at?->format('d/m/Y H:i:s') }}
                                    </td>

                                    <td class="log-token">
                                        {{ $log->token?->name ?? $log->token_id }}
                                    </td>

                                    <td >
                                        {{ $log->token?->tokenType?->name ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $log->user?->name ?? $log->user_id }}
                                    </td>

                                    <td>

                                        <span class="log-method">
                                            {{ $log->method }}
                                        </span>

                                    </td>

                                    <td>

                                        <div
                                            class="log-url"
                                            title="{{ $log->url }}"
                                        >
                                            {{ $log->url }}
                                        </div>

                                    </td>

                                    <td>

                                        @if($log->status_code >= 500)

                                            <span class="log-status log-status-server-error">
                                                {{ $log->status_code }}
                                            </span>

                                        @elseif($log->status_code >= 400)

                                            <span class="log-status log-status-client-error">
                                                {{ $log->status_code }}
                                            </span>

                                        @else

                                            <span class="log-status log-status-success">
                                                {{ $log->status_code }}
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        {{ $log->ip_address }}
                                    </td>

                                    <td>
                                        {{ $log->response_time_ms }} ms
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="8"
                                        class="empty"
                                    >
                                        No hay logs registrados.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                <!-- LOG PAGINATION -->

                @if($logs && $logs->total() > 0)

                    <div class="pagination">

                        <div class="pagination-info">

                            Mostrando

                            <strong>
                                {{ $logs->firstItem() }}
                            </strong>

                            -

                            <strong>
                                {{ $logs->lastItem() }}
                            </strong>

                            de

                            <strong>
                                {{ $logs->total() }}
                            </strong>

                        </div>

                        <div class="pagination-links">

                            @if($logs->onFirstPage())

                                <span class="pagination-button disabled">
                                    ← Anterior
                                </span>

                            @else

                                <a
                                    href="{{ $logs->previousPageUrl() }}"
                                    class="pagination-button"
                                >
                                    ← Anterior
                                </a>

                            @endif

                            @foreach(
                                $logs->getUrlRange(
                                    1,
                                    $logs->lastPage()
                                ) as $page => $url
                            )

                                @if($page == $logs->currentPage())

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

                            @if($logs->hasMorePages())

                                <a
                                    href="{{ $logs->nextPageUrl() }}"
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

        @endif

    </main>

</body>

</html>

