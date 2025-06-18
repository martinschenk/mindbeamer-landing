<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="@yield('meta_description', __('messages.hero_subtitle'))">
    <meta name="keywords"
          content="autonomous AI content, automated blog posts, autonomous social media, automated content creation, multilingual AI, MindBeamer, free demo">
    {{-- SEO Essentials (canonical, hreflang, OG, Twitter) --}}
    @include('layouts.partials.seo')
    
    {{-- Structured Data (JSON-LD) --}}
    @include('layouts.partials.structured-data')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Cdefs%3E%3ClinearGradient id='mbGrad' x1='0%25' y1='0%25' x2='100%25' y2='100%25'%3E%3Cstop offset='0%25' style='stop-color:%23EC4899'/%3E%3Cstop offset='50%25' style='stop-color:%239F7AEA'/%3E%3Cstop offset='100%25' style='stop-color:%234ECDC4'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect x='2' y='2' width='28' height='28' rx='6' fill='url(%23mbGrad)'/%3E%3Cpath d='M 8 22 L 8 10 L 12 10 L 16 18 L 20 10 L 24 10 L 24 22 L 20 22 L 20 14 L 16 22 L 12 14 L 12 22 Z' fill='white' stroke='white' stroke-width='0.5'/%3E%3C/svg%3E">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="theme-color" content="#9F7AEA">
    
    <title>@yield('title', 'MindBeamer - ' . __('messages.hero_title'))</title>
    
            }
        });
    </script>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Local Fonts (DSGVO compliant, better performance) -->
    <link href="{{ asset('css/local-fonts.css') }}" rel="stylesheet">
    
    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    
    <!-- Einfacher Locale-Helper ohne Sonderbehandlung -->
    <script>
        /**
         * MindBeamer Locale Helper
         * 
         * Einfaches Hilfsobjekt zur Ermittlung der aktuellen Sprache
         */
        window.LocaleHelper = {
            /**
             * Ermittelt die aktuelle Locale aus dem URL-Pfad
             * 
             * @returns {string} Die ermittelte Locale oder 'en' als Fallback
             */
            getCurrentLocale: function() {
                // Extrahiere die Locale aus dem URL-Pfad (z.B. /de/, /en/, /zh_CN/)
                const pathParts = window.location.pathname.split('/');
                if (pathParts.length > 1 && pathParts[1] && pathParts[1].length >= 2) {
                    const urlLocale = pathParts[1];
                    // Prüfe, ob die URL-Locale ein gültiges Format hat (z.B. 'de', 'en', 'zh_CN')
                    if (/^[a-z]{2}(_[A-Z]{2})?$/.test(urlLocale)) {
                        return urlLocale;
                    }
                }
                
                // Fallback: Verwende HTML lang-Attribut oder 'en'
                const htmlLang = document.documentElement.lang;
                return htmlLang ? htmlLang.replace('-', '_') : 'en';
            },
            
            /**
             * Stellt sicher, dass HTTP-Anfragen die korrekte Locale-Information enthalten
             * 
             * @param {Headers|Object} headers HTTP-Header-Objekt oder einfaches Objekt
             * @returns {Headers|Object} Die aktualisierten Header
             */
            addLocaleToHeaders: function(headers) {
                const locale = this.getCurrentLocale();
                
                // Wenn Headers ein Headers-Objekt ist
                if (headers instanceof Headers) {
                    headers.set('X-Locale', locale);
                } 
                // Wenn Headers ein einfaches Objekt ist
                else if (typeof headers === 'object') {
                    headers['X-Locale'] = locale;
                }
                
                return headers;
            }
        };
    </script>
    
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



    @if(class_exists(\Devrabiul\CookieConsent\Facades\CookieConsent::class))
        {!! CookieConsent::styles() !!}
    @endif
    
    <!-- MindBeamer Cookie Consent Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/cookie-consent-custom.css') }}">
    
    <style>
        html, body { overflow-x: hidden; width: 100%; }
        body { font-family: 'Poppins', sans-serif; position: relative; }
        .hero-bg { background: linear-gradient(135deg, #EC4899, #9F7AEA, #4ECDC4); }
        .btn-primary { transition: transform 0.2s, background-color 0.3s; }
        .btn-primary:hover { transform: scale(1.05); }
        /* Section title styling moved to app.css */
        .fade-in { animation: fadeIn 1s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
    
    @vite(['resources/js/app.js'])
    
    <!-- Filament Scripts entfernt -->
</head>
