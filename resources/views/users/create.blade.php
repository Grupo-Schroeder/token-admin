@extends('layouts.app')

@section('content')
    <div class="page-content">
        <x-page-heading
            title="Crear usuario"
            description="Registrá un usuario y asignale su tipo de acceso."
            :back-url="route('dashboard', ['tab' => 'users'])"
            back-label="Volver a usuarios"
        />

        <section class="form-card" aria-label="Datos del usuario">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <x-form-field name="name" label="Nombre" required>
                        <input
                            class="form-control"
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            maxlength="255"
                            placeholder="Ej.: Juan Pérez"
                            autocomplete="name"
                            required
                        >
                    </x-form-field>

                    <x-form-field name="email" label="Email" required>
                        <input
                            class="form-control"
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            maxlength="255"
                            placeholder="Ej.: usuario@lebensalud.com"
                            autocomplete="email"
                            required
                        >
                    </x-form-field>

                    <x-form-field name="token_type_id" label="Tipo de token" required class="form-field--full">
                        <select class="form-control" name="token_type_id" id="token_type_id" required>
                            <option value="">Seleccionar tipo</option>
                            @foreach ($tokenTypes as $tokenType)
                                <option value="{{ $tokenType->id }}" @selected(old('token_type_id') == $tokenType->id)>
                                    {{ $tokenType->name }}
                                </option>
                            @endforeach
                        </select>
                    </x-form-field>
                </div>

                <div class="form-actions">
                    <button class="button button-primary" type="submit">Crear usuario</button>
                    <a class="button button-secondary" href="{{ route('dashboard', ['tab' => 'users']) }}">Cancelar</a>
                </div>
            </form>
        </section>
    </div>
@endsection
