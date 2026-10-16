<header class="topbar">
    <a href="{{ route('dashboard') }}" class="topbar-brand" aria-label="Leben Salud, Token Admin">
        <span class="brand-logo">
            <img src="{{ asset('images/leben-salud-logo.png') }}" alt="Leben Salud">
        </span>
        <span class="brand-divider" aria-hidden="true"></span>
        <span class="brand-title">Token Admin</span>
    </a>

    <div class="topbar-actions">
        <button
            type="button"
            class="theme-toggle"
            data-theme-toggle
            aria-label="Cambiar tema"
            aria-pressed="false"
        >
            <svg class="icon-moon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M20.2 15.3A8.5 8.5 0 0 1 8.7 3.8 8.5 8.5 0 1 0 20.2 15.3Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <svg class="icon-sun" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.8" />
                <path d="M12 2v2m0 16v2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M2 12h2m16 0h2M4.93 19.07l1.42-1.42m11.3-11.3 1.42-1.42" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
            </svg>
        </button>

        <details class="account-menu">
            <summary class="topbar-user">
                <span class="avatar" aria-hidden="true">
                    {{ str(auth()->user()->name)->substr(0, 1)->upper() }}
                </span>
                <span class="user-details">
                    <span class="user-name">{{ auth()->user()->name }}</span>
                    <span class="user-role">{{ auth()->user()->email }}</span>
                </span>
                <svg class="account-chevron" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                    <path d="m5 7.5 5 5 5-5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </summary>

            <div class="account-dropdown">
                <p class="account-dropdown-email">{{ auth()->user()->email }}</p>
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-button">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M10 17l5-5-5-5m5 5H3m9-9h5a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span>Cerrar sesión</span>
                    </button>
                </form>
            </div>
        </details>
    </div>
</header>
