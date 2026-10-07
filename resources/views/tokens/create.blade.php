<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crear token</title>
</head>

<body>

    <main>

        <h1>Crear token</h1>

        <form action="{{ route('tokens.store') }}" method="POST">

            @csrf

            <div>
                <label for="user_id">
                    Usuario
                </label>

                <select name="user_id" id="user_id" required>

                    <option value="">
                        Seleccionar usuario
                    </option>

                    @foreach ($users as $user)

                        <option value="{{ $user->id }}">
                            {{ $user->name }} - {{ $user->email }}
                        </option>

                    @endforeach

                </select>
            </div>

            <br>

            <div>
                <label for="token_type_id">
                    Tipo de token
                </label>

                <select name="token_type_id" id="token_type_id" required>

                    <option value="">
                        Seleccionar tipo
                    </option>

                    @foreach ($tokenTypes as $tokenType)

                        <option value="{{ $tokenType->id }}">
                            {{ $tokenType->name }}
                        </option>

                    @endforeach

                </select>
            </div>

            <br>

            <div>
                <label for="name">
                    Nombre del token
                </label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    required
                    maxlength="255"
                >
            </div>
            <br>
            <div>
                <label for="expires_in">Tiempo de expiración</label>

                <select name="expires_in" id="expires_in" required>
                    <option value="15m">15 minutos</option>
                    <option value="30m">30 minutos</option>
                    <option value="1h">1 hora</option>
                    <option value="5h">5 horas</option>
                    <option value="1d">1 día</option>
                    <option value="5d">5 días</option>
                    <option value="20d">20 días</option>
                    <option value="1M">1 mes</option>
                    <option value="1y">1 año</option>
                </select>
            </div>
            <br>

            <button type="submit">
                Crear token
            </button>

        </form>

    </main>

</body>

</html>
