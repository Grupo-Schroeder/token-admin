<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Usuario creado</title>

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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .description {
            color: #555;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .success {
            background: #ecfdf3;
            border: 1px solid #abefc6;
            color: #067647;
            padding: 14px 16px;
            border-radius: 6px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .warning {
            background: #fffaeb;
            border: 1px solid #fedf89;
            color: #92400e;
            padding: 14px 16px;
            border-radius: 6px;
            margin-bottom: 25px;
            font-size: 14px;
            line-height: 1.5;
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

            font-family: monospace;
            font-size: 14px;

            color: #222;

            word-break: break-all;
        }

        .actions {
            display: flex;
            gap: 10px;

            margin-top: 30px;
        }

        button,
        a {
            display: inline-block;

            padding: 10px 15px;

            border-radius: 6px;
            border: none;

            cursor: pointer;

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

        <h1>Usuario creado correctamente</h1>

        <p class="description">
            El usuario <strong>{{ $user->name }}</strong> fue creado correctamente.
        </p>


        <div class="success">
            Las credenciales para acceder a la API fueron generadas correctamente.
        </div>


        <div class="warning">
            <strong>Importante:</strong>
            guardá estas credenciales ahora.
            El <strong>Client Secret</strong> se muestra solamente en este momento
            y no podrá recuperarse posteriormente.
        </div>


        <div class="field">

            <label for="client_key">
                Client Key
            </label>

            <div class="value" id="client_key">
                {{ $clientKey }}
            </div>

        </div>


        <div class="field">

            <label for="client_secret">
                Client Secret
            </label>

            <div class="value" id="client_secret">
                {{ $clientSecret }}
            </div>

        </div>


        <div class="field">

            <label>
                Tipo de token
            </label>

            <div class="value" style="font-family: Arial, sans-serif;">
                {{ $user->tokenType?->name ?? '—' }}
            </div>

        </div>


        <div class="actions">

            <a
                href="{{ route('dashboard', ['tab' => 'users']) }}"
                class="primary"
            >
                Ir a usuarios
            </a>

            <a
                href="{{ route('users.create') }}"
                class="back"
            >
                Crear otro usuario
            </a>

        </div>

    </div>

</main>

</body>

</html>
