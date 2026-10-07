<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crear token</title>

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

        input,
        select {
            width: 100%;
            padding: 11px 12px;

            border: 1px solid #ddd;
            border-radius: 6px;

            background: white;

            font-family: inherit;
            font-size: 14px;

            box-sizing: border-box;
        }

        input:focus,
        select:focus {
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

        <h1>Crear token</h1>

        <form action="{{ route('tokens.store') }}" method="POST">

            @csrf


            <div class="field">

                <label for="user_id">
                    Usuario <span class="required">*</span>
                </label>

                <select
                    name="user_id"
                    id="user_id"
                    required
                >

                    <option value="">
                        Seleccionar usuario
                    </option>

                    @foreach ($users as $user)

                        <option
                            value="{{ $user->id }}"
                            @selected(old('user_id') == $user->id)
                        >
                            {{ $user->name }} - {{ $user->email }}
                        </option>

                    @endforeach

                </select>

                @error('user_id')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <div class="field">

                <label for="token_type_id">
                    Tipo de token <span class="required">*</span>
                </label>

                <select
                    name="token_type_id"
                    id="token_type_id"
                    required
                >

                    <option value="">
                        Seleccionar tipo
                    </option>

                    @foreach ($tokenTypes as $tokenType)

                        <option
                            value="{{ $tokenType->id }}"
                            @selected(old('token_type_id') == $tokenType->id)
                        >
                            {{ $tokenType->name }}
                        </option>

                    @endforeach

                </select>

                @error('token_type_id')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <div class="field">

                <label for="name">
                    Nombre del token <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    maxlength="255"
                    required
                    placeholder="Ej: API Producción"
                >

                @error('name')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <div class="field">

                <label for="expires_in">
                    Tiempo de expiración <span class="required">*</span>
                </label>

                <select
                    name="expires_in"
                    id="expires_in"
                    required
                >

                    <option
                        value="15m"
                        @selected(old('expires_in', '30m') === '15m')
                    >
                        15 minutos
                    </option>

                    <option
                        value="30m"
                        @selected(old('expires_in', '30m') === '30m')
                    >
                        30 minutos
                    </option>

                    <option
                        value="1h"
                        @selected(old('expires_in') === '1h')
                    >
                        1 hora
                    </option>

                    <option
                        value="5h"
                        @selected(old('expires_in') === '5h')
                    >
                        5 horas
                    </option>

                    <option
                        value="1d"
                        @selected(old('expires_in') === '1d')
                    >
                        1 día
                    </option>

                    <option
                        value="5d"
                        @selected(old('expires_in') === '5d')
                    >
                        5 días
                    </option>

                    <option
                        value="20d"
                        @selected(old('expires_in') === '20d')
                    >
                        20 días
                    </option>

                    <option
                        value="1M"
                        @selected(old('expires_in') === '1M')
                    >
                        1 mes
                    </option>

                    <option
                        value="1y"
                        @selected(old('expires_in') === '1y')
                    >
                        1 año
                    </option>

                </select>

                @error('expires_in')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <div class="actions">

                <button type="submit">
                    Crear token
                </button>

                <a
                    href="{{ route('dashboard', ['tab' => 'tokens']) }}"
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
