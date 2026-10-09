<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detalle del token</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 40px;
        }

        main {
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 25px;
        }

        .field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #333;
        }

        .value {
            width: 100%;
            min-height: 42px;
            display: flex;
            align-items: center;
            box-sizing: border-box;
            padding: 11px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: #f8f8f8;
            font-size: 14px;
            color: #222;
        }

        .status {
            font-weight: bold;
        }

        .active {
            color: #067647;
        }

        .revoked {
            color: #b42318;
        }

        .expired {
            color: #92400e;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        a {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
            font-family: inherit;
            font-size: 14px;
        }

        .primary {
            background: #333;
            color: white;
        }

        .primary:hover {
            background: #222;
        }

        .back {
            background: #eee;
            color: #333;
        }

        .back:hover {
            background: #e2e2e2;
        }
    </style>
</head>

<body>

<main>

    <div class="card">

        <h1>Detalle del token</h1>

        <div class="field">
            <label>ID</label>

            <div class="value">
                {{ $token->id }}
            </div>
        </div>

        <div class="field">
            <label>Nombre</label>

            <div class="value">
                {{ $token->name }}
            </div>
        </div>

        <div class="field">
            <label>Usuario</label>

            <div class="value">
                {{ $token->user_name }}
            </div>
        </div>

        <div class="field">
            <label>Email</label>

            <div class="value">
                {{ $token->user_email }}
            </div>
        </div>

        <div class="field">
            <label>Tipo de token</label>

            <div class="value">
                {{ $token->token_type_name ?? '—' }}
            </div>
        </div>

        <div class="field">
            <label>Duración</label>

            <div class="value">
                {{ $token->expires_in ?? '—' }}
            </div>
        </div>

        <div class="field">
            <label>Creado</label>

            <div class="value">
                {{ $token->created_at ?? '—' }}
            </div>
        </div>

        <div class="field">
            <label>Expira</label>

            <div class="value">
                {{ $token->expires_at ?? '—' }}
            </div>
        </div>

        <div class="field">
            <label>Estado</label>

            <div class="value">

                @if ($token->revoked)
                    <span class="status revoked">Revocado</span>

                @elseif ($token->expires_at && \Carbon\Carbon::parse($token->expires_at)->isPast())
                    <span class="status expired">Expirado</span>

                @else
                    <span class="status active">Activo</span>
                @endif

            </div>
        </div>

        <div class="actions">

            <a
                href="{{ route('dashboard', ['tab' => 'tokens']) }}"
                class="back"
            >
                Volver
            </a>

        </div>

    </div>

</main>

</body>
</html>
