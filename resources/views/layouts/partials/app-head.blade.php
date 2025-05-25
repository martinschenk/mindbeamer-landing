<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
    
    <!-- MindBeamer Locale Helper - Sorgt für konsistente Spracheinstellungen -->
    <script>
        /**
         * MindBeamer Locale Helper
         * 
         * Stellt sicher, dass die Spracheinstellungen konsistent bleiben
         * Beinhaltet eine robuste Methode zur Ermittlung der aktuellen Locale
         */
        window.LocaleHelper = {
            /**
             * Ermittelt die aktuelle Locale mit einer Prioritätsreihenfolge:
             * 1. Cookie 'app_locale'
             * 2. URL-Pfad
             * 3. HTML lang-Attribut
             * 4. Default (en)
             * 
             * @returns {string} Die ermittelte Locale
             */
            getCurrentLocale: function() {
                // 1. Versuche zuerst, die Locale aus dem Cookie zu lesen
                const cookieLocale = this.getLocaleCookie();
                if (cookieLocale) {
                    console.log('Locale from cookie:', cookieLocale);
                    return cookieLocale;
                }
                
                // 2. Versuche, die Locale aus dem URL-Pfad zu extrahieren
                const pathParts = window.location.pathname.split('/');
                if (pathParts.length > 1 && pathParts[1] && pathParts[1].length >= 2) {
                    const urlLocale = pathParts[1];
                    // Prüfe, ob die URL-Locale ein gültiges Format hat (z.B. 'de', 'en', 'zh_CN')
                    if (/^[a-z]{2}(_[A-Z]{2})?$/.test(urlLocale)) {
                        console.log('Locale from URL path:', urlLocale);
                        return urlLocale;
                    }
                }
                
                // 3. Versuche, die Locale aus dem HTML lang-Attribut zu lesen
                const htmlLang = document.documentElement.lang;
                if (htmlLang) {
                    // Konvertiere Bindestrich-Format (für HTML) zurück zu Unterstrich-Format (für APIs)
                    const normalizedLang = htmlLang.replace('-', '_');
                    console.log('Locale from HTML lang attribute:', normalizedLang);
                    return normalizedLang;
                }
                
                // 4. Fallback auf Default-Locale
                console.log('No locale found, using default: en');
                return 'en';
            },
            
            /**
             * Liest die Locale aus dem Cookie 'app_locale'
             * 
             * @returns {string|null} Die Locale aus dem Cookie oder null
             */
            getLocaleCookie: function() {
                const cookies = document.cookie.split(';');
                for (let i = 0; i < cookies.length; i++) {
                    const cookie = cookies[i].trim();
                    if (cookie.startsWith('app_locale=')) {
                        return cookie.substring('app_locale='.length);
                    }
                }
                return null;
            },
            
            /**
             * Setzt die app_locale in einem Cookie
             * 
             * @param {string} locale Die zu speichernde Locale
             * @param {number} days Gültigkeitsdauer in Tagen
             */
            setLocaleCookie: function(locale, days = 30) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                const expires = "expires=" + date.toUTCString();
                document.cookie = "app_locale=" + locale + ";" + expires + ";path=/";
                console.log('Set locale cookie:', locale);
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
        
        // Initialisiere den Locale-Helper beim Laden der Seite
        document.addEventListener('DOMContentLoaded', function() {
            // Sichere die aktuelle Locale bei jedem Seitenaufruf
            const currentLocale = LocaleHelper.getCurrentLocale();
            LocaleHelper.setLocaleCookie(currentLocale);
            console.log('Initialized LocaleHelper with locale:', currentLocale);
        });
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
    
    <!-- FilamentPHP App Styles -->
    @filamentStyles
    
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
    <link rel="canonical" href="https://mindbeamer.io">
    
    @vite(['resources/js/app.js'])
    
    <!-- Filament Scripts - Must be loaded before body -->
    <script src="{{ asset('js/filament/support/support.js') }}"></script>
    <script src="{{ asset('js/filament/notifications/notifications.js') }}"></script>
</head>
