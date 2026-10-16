<nav class="tabs">

            <a
                href="{{ route('dashboard', ['tab' => 'tokens']) }}"
                class="tab {{ $tab === 'tokens' ? 'active' : '' }}"
            >
                Tokens
            </a>

            <a
                href="{{ route('dashboard', ['tab' => 'users']) }}"
                class="tab {{ $tab === 'users' ? 'active' : '' }}"
            >
                Usuarios
            </a>

            <a
                href="{{ route('dashboard', ['tab' => 'applications']) }}"
                class="tab {{ $tab === 'applications' ? 'active' : '' }}"
            >
                Aplicaciones
            </a>

            <a
                href="{{ route('dashboard', ['tab' => 'logs']) }}"
                class="tab {{ $tab === 'logs' ? 'active' : '' }}"
            >
                Logs
            </a>

        </nav>
