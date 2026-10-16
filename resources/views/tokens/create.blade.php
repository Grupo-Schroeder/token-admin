@extends('layouts.app')

@section('content')
    <div class="page-content">
        <x-page-heading
            title="Crear token"
            description="Seleccioná un usuario y definí la vigencia del nuevo token."
            :back-url="route('dashboard', ['tab' => 'tokens'])"
            back-label="Volver a tokens"
        />

        <section class="form-card" aria-label="Datos del token">
            <form action="{{ route('tokens.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <x-form-field name="user_id" label="Usuario" required class="form-field--full">
                        <select class="form-control" name="user_id" id="user_id" required>
                            <option value="">Seleccionar usuario</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>
                                    {{ $user->name }} — {{ $user->email }} — {{ $user->tokenType?->name ?? 'Sin tipo' }}
                                </option>
                            @endforeach
                        </select>
                    </x-form-field>

                    <x-form-field name="name" label="Nombre del token" required class="form-field--full">
                        <input
                            class="form-control"
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            maxlength="255"
                            placeholder="Ej.: API Producción"
                            autocomplete="off"
                            required
                        >
                    </x-form-field>

                    <x-form-field
                        name="expires_in"
                        label="Tiempo de expiración"
                        hint="El token dejará de ser válido al finalizar este período."
                        required
                        class="form-field--full"
                    >
                        <select class="form-control" name="expires_in" id="expires_in" required>
                            <option value="15m" @selected(old('expires_in', '30m') === '15m')>15 minutos</option>
                            <option value="30m" @selected(old('expires_in', '30m') === '30m')>30 minutos</option>
                            <option value="1h" @selected(old('expires_in') === '1h')>1 hora</option>
                            <option value="5h" @selected(old('expires_in') === '5h')>5 horas</option>
                            <option value="1d" @selected(old('expires_in') === '1d')>1 día</option>
                            <option value="5d" @selected(old('expires_in') === '5d')>5 días</option>
                            <option value="20d" @selected(old('expires_in') === '20d')>20 días</option>
                            <option value="1M" @selected(old('expires_in') === '1M')>1 mes</option>
                            <option value="1y" @selected(old('expires_in') === '1y')>1 año</option>
                        </select>
                    </x-form-field>
                </div>

                <div class="form-actions">
                    <button class="button button-primary" type="submit">Crear token</button>
                    <a class="button button-secondary" href="{{ route('dashboard', ['tab' => 'tokens']) }}">Cancelar</a>
                </div>
            </form>
        </section>
    </div>
@endsection
