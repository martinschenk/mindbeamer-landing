<!DOCTYPE html>
<html lang="{{ app(\App\Services\LocaleService::class)->getHtmlLangAttribute() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- SEO Meta Tags - Server-side rendered --}}
    <title>@yield('title', 'MindBeamer - Social Media That Runs Itself | Save 20+ Hours/Week')</title>
    <meta name="description" content="@yield('description', 'German-engineered content automation for B2B companies. Create and post engaging social media content automatically. Trusted by 1.4M+ websites. Start free trial.')">
    
    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', 'MindBeamer - Finally, Social Media That Runs Itself')">
    <meta property="og:description" content="@yield('og_description', 'Save 20+ hours/week with German-engineered content automation. Perfect for B2B manufacturers and service providers.')">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    
    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('twitter_title', 'MindBeamer - Social Media Automation for B2B')">
    <meta property="twitter:description" content="@yield('twitter_description', 'Automated content creation and posting. Save time, stay consistent.')">
    <meta property="twitter:image" content="{{ asset('images/twitter-card.jpg') }}">
    
    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">
    
    {{-- Hreflang tags for language versions --}}
    <link rel="alternate" hreflang="x-default" href="{{ url('/') }}">
    <link rel="alternate" hreflang="en" href="{{ url('/') }}">
    <link rel="alternate" hreflang="de" href="{{ url('/de') }}">
    <link rel="alternate" hreflang="es" href="{{ url('/es') }}">
    <link rel="alternate" hreflang="zh-CN" href="{{ url('/zh_CN') }}">
    
    {{-- Favicon --}}
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='80' x='50' text-anchor='middle' font-size='80' font-weight='700' fill='%236366f1' font-family='Poppins,sans-serif'>M</text></svg>">
    
    {{-- Preload fonts --}}
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
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
            routes: @json([
                'api.demo-request' => route('api.demo-request')
            ]),
            csrfToken: "{{ csrf_token() }}",
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
                    <svg class="animate-spin h-12 w-12 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <p class="text-gray-600">Loading MindBeamer...</p>
            </div>
        </div>
    </div>
    
    {{-- No JavaScript Fallback --}}
    <noscript>
        <div class="min-h-screen bg-white">
            <div class="container mx-auto px-6 py-12 text-center">
                <h1 class="text-3xl font-bold mb-4">JavaScript Required</h1>
                <p class="text-gray-600 mb-8">MindBeamer requires JavaScript to be enabled in your browser.</p>
                <p class="text-gray-600">Please enable JavaScript and reload the page to continue.</p>
            </div>
        </div>
    </noscript>
    
    {{-- Container for Google Analytics (dynamically filled if consent given) --}}
    <div id="google-analytics-container"></div>
    
    @stack('scripts')
</body>
</html>