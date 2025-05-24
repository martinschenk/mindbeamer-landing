<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', __('messages.hero_subtitle'))">
    <meta name="keywords" content="autonomous AI content, automated blog posts, autonomous social media, automated content creation, MindBeamer, free demo">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'MindBeamer - ' . __('messages.hero_title'))</title>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <!-- Filament Assets -->
    <link rel="stylesheet" href="{{ asset('css/filament/support/support.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filament/notifications/notifications.css') }}">
    
    <!-- Styles -->
    @livewireStyles
    <!-- Additional Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Scroll Behavior and Section Anchors -->
    <style>
        html {
            scroll-behavior: smooth;
        }
        
        /* Anker-Abschnitte mit Pseudo-Elementen */
        section[id]::before { 
            content: "";
            display: block;
            height: 80px; /* Höhe des Headers */
            margin-top: -80px; /* Negativ, damit die Position direkt unter dem Header ist */
            visibility: hidden;
            pointer-events: none;
        }
        
        /* Spezielle Anpassung für die erste Sektion (Hero) */
        section#hero::before {
            height: 0;
            margin-top: 0;
        }
    </style>
    @php
        use Devrabiul\CookieConsent\Facades\CookieConsent;
    @endphp
    
    <!-- FilamentPHP App Styles -->
    @filamentStyles
    
    @if(class_exists(\Devrabiul\CookieConsent\Facades\CookieConsent::class))
        {!! CookieConsent::styles() !!}
    @endif
    
    <!-- MindBeamer Cookie Consent Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/cookie-consent-custom.css') }}">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .hero-bg { background: linear-gradient(135deg, #EC4899, #9F7AEA, #4ECDC4); }
        .btn-primary { transition: transform 0.2s, background-color 0.3s; }
        .btn-primary:hover { transform: scale(1.05); }
        /* Section title styling moved to app.css */
        .fade-in { animation: fadeIn 1s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
    <link rel="canonical" href="https://mindbeamer.io">
    
    @vite(['resources/js/app.js'])
    
    <!-- Filament Scripts - Must be loaded before body -->
    <script src="{{ asset('js/filament/support/support.js') }}"></script>
    <script src="{{ asset('js/filament/notifications/notifications.js') }}"></script>
</head>
