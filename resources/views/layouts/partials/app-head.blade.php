<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="@yield('meta_description', __('messages.hero_subtitle'))">
    <meta name="keywords" content="autonomous AI content, automated blog posts, autonomous social media, automated content creation, MindBeamer, free demo">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'MindBeamer - ' . __('messages.hero_title'))</title>
    
    <!-- Google Analytics Test-Funktion -->
    <script>
        // Test-Funktion global verfügbar machen
        window.testAnalytics = function() {
            console.log('%c[MB-ANALYTICS] DSGVO-Konformitätstest für Google Analytics', 'background: #2196F3; color: white; padding: 5px; border-radius: 3px;');
            
            // Google Analytics-Status prüfen
            console.log('\n%c1. Allgemeiner Analytics-Status:', 'font-weight: bold;');
            
            // Prüfen, ob der gtag aktiviert oder blockiert ist
            let gtagActive = false;
            try {
                gtagActive = (typeof gtag === 'function');
            } catch (e) {
                gtagActive = false;
            }
            
            console.log('[MB-ANALYTICS] gtag-Funktion ist aktiv: ' + (gtagActive ? '%cJA ⚠️' : '%cNEIN ✅'), gtagActive ? 'color: red; font-weight: bold' : 'color: green; font-weight: bold');
            
            // Prüfen, ob GA-Skript geladen ist
            const gaScripts = document.querySelectorAll('script[src*="googletagmanager.com"]');
            console.log('[MB-ANALYTICS] Google Analytics-Skript ist geladen: ' + (gaScripts.length > 0 ? '%cJA ⚠️' : '%cNEIN ✅'), gaScripts.length > 0 ? 'color: red; font-weight: bold' : 'color: green; font-weight: bold');
            
            // dataLayer prüfen
            console.log('[MB-ANALYTICS] dataLayer existiert: ' + (window.dataLayer ? '%cJA ⚠️' : '%cNEIN ✅'), window.dataLayer ? 'color: red; font-weight: bold' : 'color: green; font-weight: bold');
            
            // Prüfen aller Google Analytics-Cookies
            console.log('\n%c2. Google Analytics-Cookies:', 'font-weight: bold;');
            
            // Hilfsfunktion zum Auslesen von Cookies
            const getCookie = function(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
                return null;
            };
            
            // Liste aller möglichen GA-Cookies prüfen
            const gaCookies = {
                '_ga': getCookie('_ga'),
                '_gid': getCookie('_gid'),
                '_gat': getCookie('_gat')
            };
            
            // Alle GA-Cookies mit G- suchen (GA4-spezifisch)
            document.cookie.split(';').forEach(cookie => {
                const trimmedCookie = cookie.trim();
                if (trimmedCookie.startsWith('_ga_')) {
                    const cookieName = trimmedCookie.split('=')[0];
                    gaCookies[cookieName] = getCookie(cookieName);
                }
            });
            
            // Ausgabe der gefundenen Cookies
            let cookiesFound = 0;
            for (const [name, value] of Object.entries(gaCookies)) {
                if (value) {
                    cookiesFound++;
                    console.log(`[MB-ANALYTICS] Cookie ${name}: %c${value} ⚠️`, 'color: red;');
                }
            }
            
            if (cookiesFound === 0) {
                console.log('%c[MB-ANALYTICS] Keine Google Analytics-Cookies gefunden ✅', 'color: green; font-weight: bold');
            } else {
                console.log('%c[MB-ANALYTICS] ' + cookiesFound + ' Google Analytics-Cookies gefunden ⚠️', 'color: red; font-weight: bold');
            }
            
            // Tracking-Versuche prüfen
            console.log('\n%c3. Tracking-Funktionalität:', 'font-weight: bold;');
            try {
                if (typeof gtag === 'function') {
                    console.log('%c[MB-ANALYTICS] gtag-Funktion ist verfügbar ⚠️', 'color: red;');
                    console.log('[MB-ANALYTICS] Sende Test-Event...');
                    gtag('event', 'test_event', {
                        'event_category': 'dsgvo_test',
                        'event_label': 'analytics_deactivation_test'
                    });
                } else {
                    console.log('%c[MB-ANALYTICS] gtag-Funktion ist nicht verfügbar ✅', 'color: green; font-weight: bold');
                }
            } catch (e) {
                console.error('[MB-ANALYTICS] Fehler beim Tracking-Test:', e);
                console.log('%c[MB-ANALYTICS] gtag-Funktion ist nicht verfügbar ✅', 'color: green; font-weight: bold');
            }
            
            // Netzwerkverbindungen zu Google Analytics prüfen
            console.log('\n%c4. Netzwerkverbindungen zu Google:', 'font-weight: bold;');
            console.log('[MB-ANALYTICS] Überprüfen Sie den Netzwerk-Tab in den Entwickler-Tools auf Verbindungen zu:');
            console.log('- googletagmanager.com');
            console.log('- google-analytics.com');
            console.log('- analytics.google.com');
            
            // Zusammenfassung und DSGVO-Bewertung
            console.log('\n%c5. DSGVO-Konformitätsbewertung:', 'font-weight: bold;');
            if (!gtagActive && gaScripts.length === 0 && !window.dataLayer && cookiesFound === 0) {
                console.log('%c[MB-ANALYTICS] DSGVO-KONFORM: Google Analytics ist vollständig deaktiviert ✅', 'background: green; color: white; padding: 5px; border-radius: 3px;');
            } else {
                console.log('%c[MB-ANALYTICS] NICHT DSGVO-KONFORM: Google Analytics ist noch aktiv oder Cookies sind vorhanden ⚠️', 'background: red; color: white; padding: 5px; border-radius: 3px;');
            }
            
            return 'DSGVO-Test abgeschlossen: ' + ((!gtagActive && cookiesFound === 0) ? 'KONFORM ✅' : 'NICHT KONFORM ⚠️');
        };
    </script>
    
    <!-- Google tag (gtag.js) - wird nur geladen, wenn Analytics aktiviert ist -->
    <script>
        // Hilfsfunktion zum Auslesen von Cookies
        function getCookieValue(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }
        
        // Prüfen, ob Analytics aktiviert ist
        const cookiePrefix = '{{ config("laravel-cookie-consent.cookie_prefix") }}' || 'MindBeamer';
        const analyticsName = `${cookiePrefix}_cookie_analytics`;
        const analyticsEnabled = getCookieValue(analyticsName) !== 'false';
        
        // Google Analytics NUR laden, wenn es explizit aktiviert ist
        if (analyticsEnabled) {
            console.log('%c[MB-ANALYTICS] Google Analytics wird AKTIVIERT', 'background: #4CAF50; color: white; padding: 5px; border-radius: 3px;');
            
            // GA-Script dynamisch laden
            const gaScript = document.createElement('script');
            gaScript.async = true;
            gaScript.src = 'https://www.googletagmanager.com/gtag/js?id=G-8ESLMYS9SV';
            document.head.appendChild(gaScript);
            
            // GA initialisieren
            window.dataLayer = window.dataLayer || [];
            window.gtag = function() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', 'G-8ESLMYS9SV');
        } else {
            console.log('%c[MB-ANALYTICS] Google Analytics wird DEAKTIVIERT', 'background: #F44336; color: white; padding: 5px; border-radius: 3px;');
            
            // Dummy-Funktion bereitstellen, damit keine Fehler auftreten
            window.gtag = function() { return null; };
        }
        
        // Hilfsfunktion, um ALLE GA-Cookies zu finden und zu löschen (gründlichere Version)
        function deleteAllGACookies() {
            // Liste der möglichen Domains, auf denen Cookies gesetzt sein könnten
            const possibleDomains = [
                '', // Leere Domain = aktueller Host
                '.mindbeamer.io',
                'mindbeamer.io',
                'www.mindbeamer.io',
                window.location.hostname
            ];
            
            // Liste der bekannten GA-Cookie-Präfixe
            const cookiePrefixes = ['_ga', '_gid', '_gat', '_gac', '_gali', '_gat_gtag'];
            
            // Alle bekannten Cookies und ihre Varianten löschen
            for (const prefix of cookiePrefixes) {
                for (const domain of possibleDomains) {
                    // Mit verschiedenen Pfaden löschen
                    const domainStr = domain ? `; Domain=${domain}` : '';
                    document.cookie = `${prefix}=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT${domainStr}; SameSite=Lax`;
                    document.cookie = `${prefix}=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT${domainStr}; SameSite=None; Secure`;
                }
            }
            
            // Alle vorhandenen Cookies durchsuchen
            const cookies = document.cookie.split(';');
            for (let i = 0; i < cookies.length; i++) {
                const cookie = cookies[i].trim();
                const cookieName = cookie.split('=')[0];
                
                // Prüfen auf dynamische GA-Cookies (z.B. _ga_XXXXXXXX)
                if (cookieName.startsWith('_ga_') || 
                    cookieName.startsWith('_gac_') || 
                    cookieName.startsWith('_gat_')) {
                    
                    for (const domain of possibleDomains) {
                        const domainStr = domain ? `; Domain=${domain}` : '';
                        document.cookie = `${cookieName}=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT${domainStr}; SameSite=Lax`;
                        document.cookie = `${cookieName}=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT${domainStr}; SameSite=None; Secure`;
                    }
                    
                    console.log('[MB-ANALYTICS] GA-Cookie gelöscht:', cookieName);
                }
            }
            
            // GA-Speicher leeren
            try {
                localStorage.removeItem('_ga');
                sessionStorage.removeItem('_ga');
            } catch (e) {
                // Ignorieren, falls localStorage nicht verfügbar ist
            }
            
            console.log('[MB-ANALYTICS] Alle Google Analytics-Cookies wurden gelöscht');
        }
        
        // Funktion zum Deaktivieren von Google Analytics (wird separat aufgerufen)
        window.disableAnalytics = function() {
            console.log('%c[MB-ANALYTICS] Google Analytics wird DEAKTIVIERT', 'background: #F44336; color: white; padding: 5px; border-radius: 3px;');
            
            // Existierende GA-Skripte entfernen
            const gaScripts = document.querySelectorAll('script[src*="googletagmanager.com"]');
            gaScripts.forEach(script => {
                console.log('[MB-ANALYTICS] Entferne GA-Skript:', script.src);
                script.remove();
            });
            
            // dataLayer zurücksetzen
            if (window.dataLayer) {
                console.log('[MB-ANALYTICS] Setze dataLayer zurück');
                delete window.dataLayer;
            }
            
            // GA-Funktion deaktivieren
            window.gtag = function() {
                console.log('[MB-ANALYTICS] Tracking-Versuch blockiert:', arguments);
                return null;
            };
            
            // Alle GA-Cookies löschen
            deleteAllGACookies();
            
            console.log('[MB-ANALYTICS] Google Analytics wurde deaktiviert');
        };
        
        // enableAnalytics-Funktion, die vom Cookie-Consent-Paket aufgerufen wird
        window.enableAnalytics = function(cookieValue) {
            console.log('\n%c[MB-ANALYTICS] ===== ANALYTICS STATUS CHANGE =====', 'background: #333; color: #fff; padding: 3px;');
            
            // Parameter ableiten, wenn nicht explizit übergeben
            // Das Cookie-Consent-Paket ruft die Funktion ohne Parameter auf, wenn Analytics aktiviert werden soll
            if (cookieValue === undefined) {
                cookieValue = 'allow';
                console.log('[MB-ANALYTICS] Kein Parameter übergeben, nehme an: allow');
            }
            
            console.log('[MB-ANALYTICS] Cookie-Wert:', cookieValue);
            
            if (cookieValue === 'allow') {
                console.log('%c[MB-ANALYTICS] Google Analytics wird AKTIVIERT', 'background: #4CAF50; color: white; padding: 5px; border-radius: 3px;');
                
                // Die Analytics-Skripte werden direkt im Markup definiert, werden aber erst hier initialisiert
                (function() {
                    // Analytics-Skript laden
                    const gaScript = document.createElement('script');
                    gaScript.async = true;
                    gaScript.src = 'https://www.googletagmanager.com/gtag/js?id=G-8ESLMYS9SV';
                    document.head.appendChild(gaScript);
                    
                    // Analytics initialisieren
                    window.dataLayer = window.dataLayer || [];
                    window.gtag = function gtag(){dataLayer.push(arguments);}
                    gtag('js', new Date());
                    gtag('config', 'G-8ESLMYS9SV');
                    
                    console.log('[MB-ANALYTICS] Google Analytics wurde initialisiert');
                })();
                
            } else if (cookieValue === 'deny') {
                // Rufe disableAnalytics auf
                window.disableAnalytics();
            }
        };
        
        // Event-Listener, der auf Änderungen der Cookie-Einstellungen reagiert
        function setupCookieConsentListener() {
            // Cookie-Wert auslesen
            const getCookie = function(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
                return null;
            };
            
            // Cookie-Prefix aus der Konfiguration
            const cookiePrefix = '{{ config("laravel-cookie-consent.cookie_prefix") }}' || 'MindBeamer';
            const analyticsName = `${cookiePrefix}_cookie_analytics`;
            
            // Prüfen, ob Analytics deaktiviert ist und ggf. deaktivieren
            function checkAndDisableAnalytics() {
                const analyticsCookie = getCookie(analyticsName);
                console.log('[MB-ANALYTICS] Cookie-Status:', analyticsCookie);
                
                if (analyticsCookie === 'false') {
                    console.log('[MB-ANALYTICS] Analytics-Cookie ist auf false gesetzt, deaktiviere Analytics');
                    window.disableAnalytics();
                }
            }
            
            // Initialen Check durchführen
            checkAndDisableAnalytics();
            
            // MutationObserver für DOM-Änderungen (Cookie-Modal-Interaktionen)
            const observer = new MutationObserver(function(mutations) {
                // Prüfen, ob relevante Änderungen vorhanden sind
                for (const mutation of mutations) {
                    if (mutation.type === 'childList' || mutation.type === 'attributes') {
                        // Auf Speichern-Button-Klicks prüfen
                        const saveButtons = document.querySelectorAll('.cookie-preferences-save, [data-cc="save"], button[class*="save"]');
                        if (saveButtons.length > 0) {
                            saveButtons.forEach(btn => {
                                if (!btn.hasAttribute('data-mb-listener')) {
                                    btn.setAttribute('data-mb-listener', 'true');
                                    btn.addEventListener('click', function() {
                                        // Kurze Verzögerung, um sicherzustellen, dass Cookies gesetzt wurden
                                        setTimeout(checkAndDisableAnalytics, 100);
                                    });
                                }
                            });
                        }
                    }
                }
            });
            
            // Beobachte den gesamten Body auf Änderungen
            observer.observe(document.body, { childList: true, subtree: true, attributes: true });
            
            // Zusätzlich Änderungen an den Cookies überwachen (sicherheitshalber)
            let lastCookieString = document.cookie;
            setInterval(function() {
                if (document.cookie !== lastCookieString) {
                    lastCookieString = document.cookie;
                    checkAndDisableAnalytics();
                }
            }, 1000); // Alle 1 Sekunde prüfen
        }
        
        // Beim Laden der Seite Cookie-Listener einrichten
        document.addEventListener('DOMContentLoaded', setupCookieConsentListener);
    </script>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
    
    <!-- FilamentPHP App Styles -->
    @filamentStyles
    
    @if(class_exists(\Devrabiul\CookieConsent\Facades\CookieConsent::class))
        {!! CookieConsent::styles() !!}
    @endif
    
    <!-- MindBeamer Cookie Consent Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/cookie-consent-custom.css') }}">
    
    <!-- DSGVO Cookie Cleanup Script (wird vor allen anderen Scripts geladen) -->
    <script src="{{ asset('js/analytics-cleanup.js') }}?v={{ time() }}"></script>
    
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
