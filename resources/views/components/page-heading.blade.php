@props([
    'title',
    'description' => null,
    'backUrl' => null,
    'backLabel' => 'Volver',
])

<header class="page-heading">
    <div>
        <h1>{{ $title }}</h1>
        @if ($description)
            <p>{{ $description }}</p>
        @endif
    </div>

    @if ($backUrl)
        <a class="button button-secondary page-back-link" href="{{ $backUrl }}">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="m14 18-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            {{ $backLabel }}
        </a>
    @endif
</header>
