<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Usuario</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 40px;
        }

        main {
            max-width: 1000px;
            margin: 0 auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);

            margin-bottom: 20px;
        }

        h1 {
            margin-top: 0;
            margin-bottom: 8px;
        }

        .email {
            color: #666;
            margin-bottom: 25px;
        }

        .info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .info-item {
            background: #f8f8f8;
            padding: 15px;
            border-radius: 6px;
        }

        .info-label {
            display: block;
            color: #777;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 18px;
            font-weight: bold;
        }


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

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: bold;
        }

        .active {
            background: #d1fae5;
            color: #047857;
        }

        .expired {
            background: #fef3c7;
            color: #92400e;
        }

        .revoked {
            background: #fee2e2;
            color: #b91c1c;
        }

        .back {
            display: inline-block;

            padding: 10px 15px;

            border-radius: 6px;

            background: #eee;
            color: #333;

            text-decoration: none;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #777;
        }
    </style>
</head>

<body>

<main>

    <!-- Usuario -->

    <div class="card">

        <h1>
            {{ $user->name }}
        </h1>

        <div class="email">
            {{ $user->email }}
        </div>

        <div class="info">

            <div class="info-item">

                <span class="info-label">
                    Nombre
                </span>

                <span class="info-value">
                    {{ $user->name }}
                </span>

            </div>

            <div class="info-item">

                <span class="info-label">
                    Email
                </span>

                <span class="info-value">
                    {{ $user->email }}
                </span>

            </div>

            <div class="info-item">

                <span class="info-label">
                    Tokens
                </span>

                <span class="info-value">
                    {{ $tokens->count() }}
                </span>

            </div>

        </div>

    </div>


    <!-- Tokens -->

    <div class="card">

        <h2>
            Tokens
        </h2>

        <br>

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

                </tr>

            </thead>

            <tbody>

                @forelse($tokens as $token)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $token->name }}
                        </td>

                        <td>
                            {{ $token->token_type_name ?? 'Sin tipo' }}
                        </td>

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

                        <td>
                            {{ \Carbon\Carbon::parse($token->created_at)->format('d/m/Y H:i') }}
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($token->expires_at)->format('d/m/Y H:i') }}
                        </td>

                        <td>

                            @if($token->revoked)

                                <span class="status revoked">
                                    Revocado
                                </span>

                            @elseif(\Carbon\Carbon::parse($token->expires_at)->isPast())

                                <span class="status expired">
                                    Expirado
                                </span>

                            @else

                                <span class="status active">
                                    Activo
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="empty"
                        >
                            Este usuario todavía no tiene tokens.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <a
        href="{{ route('dashboard', ['tab' => 'users']) }}"
        class="back"
    >
        Volver a usuarios
    </a>

</main>

</body>

</html>
