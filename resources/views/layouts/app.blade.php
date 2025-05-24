<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.partials.app-head')
<body class="bg-gray-50 text-gray-900">

    @include('components.header')

    @yield('content')
    
    @if(isset($slot))
        {{ $slot }}
    @endif

    @include('components.footer')

    <!-- Filament Notifications Container -->
    <div id="notifications"></div>
    
    @include('layouts.partials.app-notification-system')
    
    @include('layouts.partials.app-cookie-consent')
    
    @include('layouts.partials.app-contact-form-js')
    
    @livewireScripts
    @filamentScripts
</body>
</html>
