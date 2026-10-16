@extends('layouts.app')

@section('content')
    <div class="page-content">
        <x-page-heading
            title="Crear aplicación"
            description="Registrá una aplicación para administrar su acceso OAuth."
            :back-url="route('dashboard', ['tab' => 'applications'])"
            back-label="Volver a aplicaciones"
        />

        <section class="form-card" aria-label="Datos de la aplicación">
            @if ($errors->any())
                <div class="form-error-summary" role="alert">
                    <strong>Revisá los siguientes errores:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('applications.store') }}" method="POST">
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
                            placeholder="Ej.: API Clínica Go"
                            required
                        >
                    </x-form-field>

                    <x-form-field name="slug" label="Slug" required hint="Usá letras, números y guiones.">
                        <input
                            class="form-control"
                            type="text"
                            name="slug"
                            id="slug"
                            value="{{ old('slug') }}"
                            maxlength="255"
                            placeholder="Ej.: api-clinica-go"
                            required
                        >
                    </x-form-field>

                    <x-form-field name="description" label="Descripción" class="form-field--full">
                        <textarea
                            class="form-control"
                            name="description"
                            id="description"
                            maxlength="1000"
                            placeholder="Describí para qué sirve esta aplicación"
                        >{{ old('description') }}</textarea>
                    </x-form-field>

                    <x-form-field name="status" label="Estado" required>
                        <select class="form-control" name="status" id="status" required>
                            <option value="active" @selected(old('status', 'active') === 'active')>Activa</option>
                            <option value="inactive" @selected(old('status') === 'inactive')>Inactiva</option>
                        </select>
                    </x-form-field>
                </div>

                <div class="form-actions">
                    <button class="button button-primary" type="submit">Crear aplicación</button>
                    <a class="button button-secondary" href="{{ route('dashboard', ['tab' => 'applications']) }}">Cancelar</a>
                </div>
            </form>
        </section>
    </div>
@endsection
