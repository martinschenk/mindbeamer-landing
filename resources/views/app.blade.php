<!DOCTYPE html>
<html lang="{{ app(\App\Services\LocaleService::class)->getHtmlLangAttribute() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- SEO Meta Tags - Server-side rendered --}}
    <title>@yield('title', __('messages.meta_title'))</title>
    <meta name="description" content="@yield('description', __('messages.meta_description'))">
    
    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', __('messages.meta_title'))">
    <meta property="og:description" content="@yield('og_description', __('messages.meta_description'))">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    
    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('twitter_title', __('messages.meta_title'))">
    <meta property="twitter:description" content="@yield('twitter_description', __('messages.meta_description'))">
    <meta property="twitter:image" content="{{ asset('images/twitter-card.jpg') }}">
    
    {{-- Canonical URL --}}
    @php
        // For English pages accessed via /en, canonical should point to root domain
        // This prevents duplicate content issues (SEO best practice)
        $canonicalUrl = (app()->getLocale() === 'en' && request()->is('en') && !request()->is('en/*'))
            ? url('/')
            : url()->current();
    @endphp
    <link rel="canonical" href="{{ $canonicalUrl }}">
    
    {{-- Hreflang tags for language versions --}}
    <link rel="alternate" hreflang="x-default" href="{{ url('/') }}">
    <link rel="alternate" hreflang="en" href="{{ url('/') }}">
    <link rel="alternate" hreflang="de" href="{{ url('/de') }}">
    <link rel="alternate" hreflang="es" href="{{ url('/es') }}">
    <link rel="alternate" hreflang="zh-CN" href="{{ url('/zh_CN') }}">
    <link rel="alternate" hreflang="pt-BR" href="{{ url('/pt_BR') }}">
    <link rel="alternate" hreflang="fr" href="{{ url('/fr') }}">
    <link rel="alternate" hreflang="hi" href="{{ url('/hi') }}">
    
    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    
    {{-- Preload fonts - Using local Poppins for GDPR compliance --}}
    <link href="{{ asset('css/local-fonts.css') }}" rel="stylesheet">
    
    {{-- PrimeIcons --}}
    <link rel="stylesheet" href="https://unpkg.com/primeicons@7.0.0/primeicons.css">
    
    {{-- Calendly Widget CSS --}}
    <link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
    
    {{-- Structured Data --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "MindBeamer",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/logo.png') }}",
        "description": "German-engineered content automation for B2B companies",
        "founder": {
            "@type": "Person",
            "name": "Martin Schenk",
            "url": "https://martin-schenk.es"
        },
        "foundingDate": "2024",
        "sameAs": [
            "https://twitter.com/mindbeamer",
            "https://linkedin.com/company/mindbeamer"
        ]
    }
    </script>
    
    {{-- Vue App Data --}}
    <script>
        window.__APP_DATA__ = {
            locale: "{{ app()->getLocale() }}",
            translations: @json(__('messages')),
            cookieTranslations: @json(__('cookie-consent')),
            legalTranslations: @json(__('legal')),
            privacyTranslations: @json(__('privacy')),
            routes: @json([
                'api.demo-request' => route('api.demo-request')
            ]),
            csrfToken: "{{ csrf_token() }}",
            localeConfig: @json([
                'availableLocales' => config('languages.available_locales'),
                'localeNames' => config('languages.locale_names'),
                'localeFlags' => config('languages.locale_flags')
            ]),
            @if(isset($preferredLocale))
            preferredLocale: "{{ $preferredLocale }}",
            @endif
            @if(isset($isRootDomain))
            isRootDomain: {{ $isRootDomain ? 'true' : 'false' }},
            @endif
        };
    </script>
    
    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Ensure Poppins font is used consistently --}}
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    {{-- Additional head content --}}
    @stack('head')
</head>
<body class="bg-gray-50 text-gray-900">
    {{-- Vue App Mount Point --}}
    <div id="app">
        {{-- Loading State --}}
        <div class="min-h-screen flex items-center justify-center">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 mb-4">
                    <svg class="animate-spin h-12 w-12 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <p class="text-gray-600">Loading <span translate="no">MindBeamer</span>...</p>
            </div>
        </div>
    </div>
    
    {{-- No JavaScript Fallback --}}
    <noscript>
        <div class="min-h-screen bg-white">
            <div class="container mx-auto px-6 py-12 text-center">
                <h1 class="text-3xl font-bold mb-4">JavaScript Required</h1>
                <p class="text-gray-600 mb-8"><span translate="no">MindBeamer</span> requires JavaScript to be enabled in your browser.</p>
                <p class="text-gray-600">Please enable JavaScript and reload the page to continue.</p>
            </div>
        </div>
    </noscript>
    
    {{-- Container for Google Analytics (dynamically filled if consent given) --}}
    <div id="google-analytics-container"></div>
    
    @stack('scripts')
</body>
</html>