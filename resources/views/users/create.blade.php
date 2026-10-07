<!DOCTYPE html>
<html>
<head>
    <title>Usuarios</title>
</head>
<body>
<h1>Crear usuario</h1>

<form action="/usr" method="POST">
    @csrf

    <div>
        <label for="name">Nombre</label>
        <input
            type="text"
            name="name"
            id="name"
            value="{{ old('name') }}"
        >

        @error('name')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="email">Email</label>
        <input
            type="email"
            name="email"
            id="email"
            value="{{ old('email') }}"
        >

        @error('email')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="password">Contraseña</label>
        <input
            type="password"
            name="password"
            id="password"
        >

        @error('password')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="password_confirmation">
            Confirmar contraseña
        </label>

        <input
            type="password"
            name="password_confirmation"
            id="password_confirmation"
        >
    </div>

    <button type="submit">
        Crear usuario
    </button>
</form>
</body>
</html>
