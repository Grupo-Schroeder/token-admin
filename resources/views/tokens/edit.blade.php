<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Cambiar token</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 40px;
            color: #172033;
        }

        main {
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 8px;
            font-size: 24px;
        }

        .description {
            color: #6b7280;
            margin-bottom: 28px;
            font-size: 14px;
        }

        .field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
            color: #333;
            font-size: 13px;
        }

        .value {
            width: 100%;
            min-height: 42px;

            display: flex;
            align-items: center;

            padding: 11px 12px;

            border: 1px solid #ddd;
            border-radius: 6px;

            background: #f8f8f8;

            font-size: 14px;
            color: #222;
        }

        select {
            width: 100%;
            height: 42px;

            padding: 0 12px;

            border: 1px solid #d1d5db;
            border-radius: 6px;

            background: #ffffff;
            color: #374151;

            font-family: inherit;
            font-size: 14px;

            cursor: pointer;
        }

        select:focus {
            outline: none;
            border-color: #6366f1;
        }

        .status {
            font-weight: 600;
        }

        .active {
            color: #047857;
        }

        .revoked {
            color: #b91c1c;
        }

        .expired {
            color: #b45309;
        }

        .error {
            margin-top: 6px;
            color: #b42318;
            font-size: 13px;
        }

        .warning {
            margin-bottom: 24px;

            padding: 12px 14px;

            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 7px;

            color: #92400e;

            font-size: 13px;
            line-height: 1.5;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-top: 30px;
        }

        button,
        a {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            height: 36px;
            padding: 0 14px;

            border-radius: 6px;

            font-family: inherit;
            font-size: 13px;
            font-weight: 600;

            text-decoration: none;

            cursor: pointer;
        }

        .primary {
            border: 1px solid #6366f1;

            background: #6366f1;
            color: #ffffff;
        }

        .primary:hover {
            background: #4f46e5;
            border-color: #4f46e5;
        }

        .back {
            border: 1px solid #e5e7eb;

            background: #ffffff;
            color: #374151;
        }

        .back:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

    </style>

</head>

<body>

<main>

    <div class="card">

        <h1>Cambiar token</h1>

        <p class="description">
            Modificá la configuración de expiración de este token.
        </p>

        @if(session('error'))

            <div class="warning">
                {{ session('error') }}
            </div>

        @endif

        <div class="field">

            <label>
                ID
            </label>

            <div class="value">
                {{ $token->id }}
            </div>

        </div>

        <div class="field">

            <label>
                Nombre
            </label>

            <div class="value">
                {{ $token->name }}
            </div>

        </div>

        <div class="field">

            <label>
                Usuario
            </label>

            <div class="value">
                {{ $token->user_name }}
            </div>

        </div>

        <div class="field">

            <label>
                Email
            </label>

            <div class="value">
                {{ $token->user_email }}
            </div>

        </div>

        <div class="field">

            <label>
                Tipo de token
            </label>

            <div class="value">
                {{ $token->token_type_name ?? '—' }}
            </div>

        </div>

        <div class="field">

            <label for="expires_in">
                Nueva duración
            </label>

            <form
                action="{{ route('tokens.update', $token->id) }}"
                method="POST"
                id="token-form"
            >

                @csrf

                @method('PUT')

                <select
                    name="expires_in"
                    id="expires_in"
                    required
                >

                    <option
                        value="15m"
                        @selected($token->expires_in === '15m')
                    >
                        15 minutos
                    </option>

                    <option
                        value="30m"
                        @selected($token->expires_in === '30m')
                    >
                        30 minutos
                    </option>

                    <option
                        value="1h"
                        @selected($token->expires_in === '1h')
                    >
                        1 hora
                    </option>

                    <option
                        value="5h"
                        @selected($token->expires_in === '5h')
                    >
                        5 horas
                    </option>

                    <option
                        value="1d"
                        @selected($token->expires_in === '1d')
                    >
                        1 día
                    </option>

                    <option
                        value="5d"
                        @selected($token->expires_in === '5d')
                    >
                        5 días
                    </option>

                    <option
                        value="20d"
                        @selected($token->expires_in === '20d')
                    >
                        20 días
                    </option>

                    <option
                        value="1M"
                        @selected($token->expires_in === '1M')
                    >
                        1 mes
                    </option>

                    <option
                        value="1y"
                        @selected($token->expires_in === '1y')
                    >
                        1 año
                    </option>

                </select>

                @error('expires_in')

                    <div class="error">
                        {{ $message }}
                    </div>

                @enderror

            </form>

        </div>

        <div class="field">

            <label>
                Creado
            </label>

            <div class="value">
                {{ \Carbon\Carbon::parse($token->created_at)->format('d/m/Y H:i') }}
            </div>

        </div>

        <div class="field">

            <label>
                Vencimiento actual
            </label>

            <div class="value">
                {{ \Carbon\Carbon::parse($token->expires_at)->format('d/m/Y H:i') }}
            </div>

        </div>

        <div class="field">

            <label>
                Estado
            </label>

            <div class="value">

                @if($token->revoked)

                    <span class="status revoked">
                        Revocado
                    </span>

                @elseif(
                    $token->expires_at &&
                    \Carbon\Carbon::parse($token->expires_at)->isPast()
                )

                    <span class="status expired">
                        Expirado
                    </span>

                @else

                    <span class="status active">
                        Activo
                    </span>

                @endif

            </div>

        </div>

        <div class="warning">
            Al guardar, se actualizará la fecha de vencimiento del token.
            El access token no se modifica.
        </div>

        <div class="actions">

            <button
                type="submit"
                form="token-form"
                class="primary"
            >
                Guardar cambios
            </button>

            <a
                href="{{ route('tokens.show', $token->id) }}"
                class="back"
            >
                Cancelar
            </a>

        </div>

    </div>

</main>

</body>

</html>
