<!DOCTYPE html>
<html>
<head>
    <title>Usuarios</title>
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
