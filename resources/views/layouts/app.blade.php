<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f5f7fb">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <title>Token Admin | Leben Salud</title>

    <script>
        const savedTheme = localStorage.getItem('leben-theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        document.documentElement.classList.toggle(
            'dark',
            savedTheme === 'dark' || (savedTheme === null && prefersDark),
        );
    </script>

    @vite(['resources/js/app.js'])
    @include('dashboard.partials.styles')
    @stack('styles')
</head>

<body>
    @include('dashboard.partials.header')

    <main class="main">
        @if (session('success'))
            <div class="success-message" role="status">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="error-message" role="alert">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

    <dialog
        class="app-modal"
        data-confirm-dialog
        aria-labelledby="confirm-dialog-title"
        aria-describedby="confirm-dialog-message"
    >
        <div class="app-modal-card">
            <div class="app-modal-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M12 8v4m0 4h.01M10.3 3.9 1.9 18.4A1.8 1.8 0 0 0 3.5 21h17a1.8 1.8 0 0 0 1.6-2.6L13.7 3.9a2 2 0 0 0-3.4 0Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <h2 id="confirm-dialog-title" data-confirm-title>Confirmar acción</h2>
            <p id="confirm-dialog-message" data-confirm-message></p>
            <div class="app-modal-actions">
                <button class="button button-secondary" type="button" data-confirm-cancel>Cancelar</button>
                <button class="button button-primary" type="button" data-confirm-accept>Confirmar</button>
            </div>
        </div>
    </dialog>

    @stack('scripts')
</body>

</html>
