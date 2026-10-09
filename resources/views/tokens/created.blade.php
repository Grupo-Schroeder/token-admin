<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Token creado</title>

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

        .warning {
            background: #fff3cd;
            border: 1px solid #ffe69c;
            color: #664d03;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 25px;
        }

        .token-container {
            display: flex;
            gap: 10px;
            align-items: stretch;
        }

        .token {
            flex: 1;
            background: #f1f1f1;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 12px;
            font-family: monospace;
            word-break: break-all;
        }

        button,
        a {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        button {
            background: #333;
            color: white;
        }

        .back {
            margin-top: 20px;
            background: #eee;
            color: #333;
        }

        .info {
            margin-bottom: 20px;
        }

        .info strong {
            display: inline-block;
            min-width: 100px;
        }
    </style>
</head>

<body>

<main>
    <div class="card">

        <h1>Token creado</h1>

        <div class="warning">
            <strong>Importante:</strong>
            este token se muestra completo solamente ahora.
            Guardalo en un lugar seguro porque no vas a poder recuperarlo después.
        </div>

        <div class="info">
            <p>
                <strong>Usuario:</strong>
                {{ $user->name }} - {{ $user->email }}
            </p>

        </div>

        <h2>Access Token</h2>

        <div class="token-container">
            <div class="token" id="access-token">
                {{ $token }}
            </div>

            <button type="button" onclick="copyToken()">
                Copiar
            </button>
        </div>

        <a href="{{ route('dashboard') }}" class="back">
            Volver al dashboard
        </a>

    </div>
</main>

<script>
    function copyToken() {
        const token = document.getElementById('access-token').innerText;

        navigator.clipboard.writeText(token);

        alert('Token copiado al portapapeles');
    }
</script>

</body>
</html>

