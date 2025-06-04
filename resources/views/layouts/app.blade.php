<!DOCTYPE html>
{{-- 
    Verwende unseren verbesserten LocaleService für das HTML lang Attribut 
    Kritisch für die korrekte Darstellung von Chinesisch (zh_CN vs zh-CN)
--}}
<html lang="{{ app(\App\Services\LocaleService::class)->getHtmlLangAttribute() }}">
@include('layouts.partials.app-head')
<body class="bg-gray-50 text-gray-900">
    <!-- Container für Google Analytics (wird dynamisch gefüllt wenn Consent vorhanden) -->
    <div id="google-analytics-container"></div>

    @include('components.header')

    @yield('content')
    
    @if(isset($slot))
        {{ $slot }}
    @endif

    @include('components.footer')

    <!-- Benachrichtigungscontainer -->
    <div id="notifications"></div>
    
    @include('layouts.partials.app-notification-system')
    
    @include('layouts.partials.app-contact-form-js')



    <!-- Cookie-Consent-Banner -->
    @include('components.cookie-consent')
</body>
</html>
