<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crear usuario</title>

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

        input {
            width: 100%;
            padding: 11px 12px;

            border: 1px solid #ddd;
            border-radius: 6px;

            background: white;

            font-family: inherit;
            font-size: 14px;

            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: #999;
        }

        .error {
            margin-top: 6px;

            color: #b42318;
            font-size: 13px;
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

        button {
            background: #333;
            color: white;
        }

        button:hover {
            background: #222;
        }

        .back {
            background: #eee;
            color: #333;
        }

        .back:hover {
            background: #e2e2e2;
        }

        .required {
            color: #b42318;
        }
    </style>
</head>

<body>

<main>

    <div class="card">

        <h1>Crear usuario</h1>

        <form action="{{ route('users.store') }}" method="POST">

            @csrf


            <div class="field">

                <label for="name">
                    Nombre <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    maxlength="255"
                    required
                    placeholder="Ej: Juan Pérez"
                >

                @error('name')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <div class="field">

                <label for="email">
                    Email <span class="required">*</span>
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    maxlength="255"
                    required
                    placeholder="Ej: test@lebensalud.com"
                >

                @error('email')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <div class="actions">

                <button type="submit">
                    Crear usuario
                </button>

                <a
                    href="{{ route('dashboard', ['tab' => 'users']) }}"
                    class="back"
                >
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</main>

</body>

</html>
