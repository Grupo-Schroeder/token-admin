@extends('layouts.app')

@section('content')
    @php
        $tab = request()->query('tab', 'tokens');
    @endphp

    @include('dashboard.partials.navigation')

    @if ($tab === 'tokens')
        @include('dashboard.tabs.tokens')
    @elseif ($tab === 'users')
        @include('dashboard.tabs.users')
    @elseif ($tab === 'logs')
        @include('dashboard.tabs.logs')
    @elseif ($tab === 'applications')
        @include('applications.index')
    @endif
@endsection
