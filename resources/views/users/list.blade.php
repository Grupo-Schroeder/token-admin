<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>Token Admin | Leben Salud</title>
</head>
<body>
    <h1>Lista de usuarios</h1>
    <a href="/usr/create">
        <button type="button">Nuevo usuario</button>
    </a>

    @foreach ($users as $user)
        <div>
            <p>ID: {{ $user->id }}</p>
            <p>Nombre: {{ $user->name }}</p>
            <p>Email: {{ $user->email }}</p>
        </div>
    @endforeach
</body>
</html>
