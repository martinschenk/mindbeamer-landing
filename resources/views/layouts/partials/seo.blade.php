@php
    $base = 'https://mindbeamer.io';
    $locales = config('languages.available_locales', ['en','de','es','zh_CN','pt_BR','fr','hi']);

    // Mapping: canonical page key -> locale -> slug
    $slugTranslations = [
        '' => [
            'en' => '',
            'de' => '',
            'es' => '',
            'zh_CN' => '',
            'pt_BR' => '',
            'fr' => '',
            'hi' => '',
        ],
        'privacy-policy' => [
            'en' => 'privacy-policy',
            'de' => 'datenschutz-richtlinie',
            'es' => 'politica-privacidad',
            'zh_CN' => 'privacy-policy',
            'pt_BR' => 'politica-privacidade',
            'fr' => 'politique-confidentialite',
            'hi' => 'gizla-niti',
        ],
        'impressum' => [
            'en' => 'legal-notice',
            'de' => 'impressum',
            'es' => 'aviso-legal',
            'zh_CN' => 'legal-notice',
            'pt_BR' => 'aviso-legal',
            'fr' => 'mentions-legales',
            'hi' => 'vidhi-suchna',
        ],
        'terms' => [
            'en' => 'terms',
            'de' => 'agb',
            'es' => 'terminos',
            'zh_CN' => 'terms',
            'pt_BR' => 'termos',
            'fr' => 'conditions',
            'hi' => 'sharten',
        ],
    ];

    $pageKey = $pageKey ?? '';
    $currentLocale = app()->getLocale();
    $isRootDomain = $isRootDomain ?? false;

    // If we're on the root domain or English, canonical should not have /en prefix
    if ($isRootDomain && $pageKey === '') {
        $canonical = $base;  // No trailing slash for root domain
    } elseif ($currentLocale === 'en') {
        // English pages don't use /en prefix
        $slugForLocale = $slugTranslations[$pageKey]['en'] ?? $pageKey;
        if ($slugForLocale === '') {
            $canonical = $base;  // No trailing slash for homepage
        } else {
            $canonical = rtrim($base, '/') . '/' . rtrim($slugForLocale, '/');  // No trailing slash
        }
    } else {
        $slugForLocale = $slugTranslations[$pageKey][$currentLocale] ?? $pageKey;
        if ($slugForLocale === '') {
            $canonical = rtrim($base, '/') . '/' . $currentLocale;  // No trailing slash
        } else {
            $canonical = rtrim($base, '/') . '/' . $currentLocale . '/' . rtrim($slugForLocale, '/');  // No trailing slash
        }
    }
@endphp

        <!-- Canonical URL -->
<link rel="canonical" href="{{ $canonical }}">

<!-- hreflang alternate links -->
@foreach($locales as $loc)
    @php
        $slug = $slugTranslations[$pageKey][$loc] ?? $pageKey;
        // English pages don't use /en prefix
        if ($loc === 'en') {
            if ($slug === '') {
                $url = $base;  // No trailing slash for homepage
            } else {
                $url = rtrim($base, '/') . '/' . rtrim($slug, '/');  // No trailing slash
            }
        } else {
            if ($slug === '') {
                $url = rtrim($base, '/') . '/' . $loc;  // No trailing slash
            } else {
                $url = rtrim($base, '/') . '/' . $loc . '/' . rtrim($slug, '/');  // No trailing slash
            }
        }
        // Convert internal locale codes to proper hreflang codes
        $hreflangCode = match($loc) {
            'zh_CN' => 'zh-CN',
            'pt_BR' => 'pt-BR',
            default => $loc
        };
    @endphp
    <link rel="alternate" hreflang="{{ $hreflangCode }}" href="{{ $url }}">
@endforeach
@if($pageKey === '')
    <link rel="alternate" hreflang="x-default" href="{{ $base }}">
@else
    @php
        $defaultSlug = $slugTranslations[$pageKey]['en'] ?? $pageKey;
        $xDefaultUrl = rtrim($base, '/') . '/' . rtrim($defaultSlug, '/');  // No trailing slash
    @endphp
    <link rel="alternate" hreflang="x-default" href="{{ $xDefaultUrl }}">
@endif

<!-- Robots -->
<meta name="robots" content="index,follow">

<!-- Open Graph -->
<meta property="og:title"
      content="@yield('og_title', trim(View::hasSection('title') ? View::yieldContent('title') : 'MindBeamer'))">
<meta property="og:description" content="@yield('og_description', __('messages.meta_description'))">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:site_name" content="MindBeamer">
<meta property="og:locale" content="{{ str_replace('_', '-', $currentLocale) }}">
<meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title"
      content="@yield('twitter_title', trim(View::hasSection('title') ? View::yieldContent('title') : 'MindBeamer'))">
<meta name="twitter:description" content="@yield('twitter_description', __('messages.meta_description'))">
<meta name="twitter:image" content="@yield('twitter_image', asset('images/og-default.jpg'))">
