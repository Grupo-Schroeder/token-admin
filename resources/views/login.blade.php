<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#075b9c">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <title>Token Admin | Leben Salud</title>

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        const savedTheme = localStorage.getItem('leben-theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if ((savedTheme ?? (prefersDark ? 'dark' : 'light')) === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>

<body class="min-h-screen bg-white font-sans text-slate-900 antialiased dark:bg-slate-950 dark:text-slate-100">
    <main class="grid min-h-screen lg:grid-cols-[1.15fr_0.85fr]">
        <section class="relative isolate flex min-h-[360px] flex-col justify-end overflow-hidden bg-[#075b9c] px-7 py-10 text-white sm:px-12 sm:py-14 lg:min-h-screen lg:px-16 lg:py-16 xl:px-20">
            <img
                src="{{ asset('images/leben-salud-cardiologia.jpg') }}"
                alt=""
                class="absolute inset-0 -z-20 h-full w-full object-cover"
            >
            <div class="absolute inset-0 -z-10 bg-gradient-to-br from-[#075b9c]/90 via-[#0876b1]/80 to-[#00a9bc]/70"></div>
            <div class="absolute -left-24 top-16 -z-10 size-72 rounded-full border border-white/15 sm:size-96"></div>
            <div class="absolute -right-24 top-1/3 -z-10 size-64 rounded-full border border-white/15 sm:size-80"></div>

            <div class="mb-auto flex items-center gap-3 text-sm font-semibold tracking-[0.2em] text-white/90">
                <span class="grid size-10 place-items-center rounded-xl border border-white/30 bg-white/10 backdrop-blur-sm" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" class="size-5" aria-hidden="true">
                        <rect x="4" y="10" width="16" height="11" rx="2" stroke="currentColor" stroke-width="1.8" />
                        <path d="M8 10V7a4 4 0 0 1 8 0v3m-4 5v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                </span>
                PORTAL DE GESTIÓN
            </div>

            <div class="max-w-2xl">
                <span class="inline-flex rounded-full border border-white/35 bg-white/10 px-4 py-2 text-xs font-semibold tracking-[0.16em] backdrop-blur-sm">
                    LEBEN SALUD
                </span>
                <h1 class="mt-6 max-w-xl text-4xl font-semibold leading-[1.08] tracking-tight sm:text-5xl xl:text-6xl">
                    Gestión simple para cuidar mejor.
                </h1>
                <p class="mt-5 max-w-lg text-base leading-7 text-white/85 sm:text-lg">
                    Administrá usuarios, aplicaciones y accesos desde un único lugar.
                </p>
                <div class="mt-10 flex items-center gap-3 text-sm text-white/80">
                    <span class="h-px w-10 bg-[#48d1d7]"></span>
                    Excelencia para la vida
                </div>
            </div>
        </section>

        <section class="relative flex min-h-[520px] items-center justify-center px-6 py-16 sm:px-12 lg:min-h-screen lg:px-14">
            <button
                type="button"
                data-theme-toggle
                aria-label="Activar modo oscuro"
                aria-pressed="false"
                class="absolute right-5 top-5 grid size-11 place-items-center rounded-xl border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#0876b1] dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800 sm:right-8 sm:top-8"
            >
                <svg data-theme-icon="dark" viewBox="0 0 24 24" fill="none" class="hidden size-5 dark:block" aria-hidden="true">
                    <path d="M20.2 15.3A8.5 8.5 0 0 1 8.7 3.8 8.5 8.5 0 1 0 20.2 15.3Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <svg data-theme-icon="light" viewBox="0 0 24 24" fill="none" class="size-5 dark:hidden" aria-hidden="true">
                    <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.8" />
                    <path d="M12 2v2m0 16v2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M2 12h2m16 0h2M4.93 19.07l1.42-1.42m11.3-11.3 1.42-1.42" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                </svg>
            </button>

            <div class="w-full max-w-md">
                <div class="mb-12 inline-flex rounded-xl bg-white px-3 py-2 shadow-sm ring-1 ring-slate-200/70 dark:ring-slate-700">
                    <img
                        src="{{ asset('images/leben-salud-logo.png') }}"
                        alt="Leben Salud — Excelencia para la vida"
                        class="h-12 w-auto max-w-[250px] object-contain sm:h-14"
                    >
                </div>

                <p class="text-xs font-semibold tracking-[0.24em] text-[#0876b1] dark:text-cyan-400">BIENVENIDO/A</p>
                <h2 class="mt-3 text-3xl font-semibold tracking-tight text-slate-950 dark:text-white sm:text-4xl">
                    Ingresá al portal
                </h2>
                <p class="mt-4 text-sm leading-6 text-slate-500 dark:text-slate-400 sm:text-base">
                    Usá tu cuenta corporativa para administrar accesos y aplicaciones.
                </p>

                <a
                    href="{{ route('google.redirect') }}"
                    class="mt-9 flex min-h-12 w-full items-center justify-center gap-3 rounded-lg bg-[#0866a8] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#07578f] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#0876b1] dark:bg-cyan-600 dark:hover:bg-cyan-500"
                >
                    <svg viewBox="0 0 48 48" class="size-5" aria-hidden="true">
                        <path fill="#FFC107" d="M43.6 24.5c0-1.4-.1-2.8-.4-4.1H24v7.8h11a9.4 9.4 0 0 1-4.1 6.2v5.1h6.6c3.9-3.6 6.1-8.8 6.1-15Z" />
                        <path fill="#4CAF50" d="M24 44c5.5 0 10.1-1.8 13.5-4.9l-6.6-5.1c-1.8 1.2-4.1 1.9-6.9 1.9-5.3 0-9.8-3.6-11.4-8.4H5.8v5.3A20 20 0 0 0 24 44Z" />
                        <path fill="#1976D2" d="M12.6 27.5a12 12 0 0 1 0-7v-5.3H5.8a20 20 0 0 0 0 17.6l6.8-5.3Z" />
                        <path fill="#EA4335" d="M24 12.1c3 0 5.7 1 7.8 3.1l5.8-5.8C34.1 6.1 29.5 4 24 4A20 20 0 0 0 5.8 15.2l6.8 5.3c1.6-4.8 6.1-8.4 11.4-8.4Z" />
                    </svg>
                    Continuar con Google
                </a>

                <p class="mt-6 text-center text-xs leading-5 text-slate-500 dark:text-slate-400">
                    El acceso está protegido por la autenticación corporativa de Google.
                </p>
            </div>
        </section>
    </main>
</body>

</html>
