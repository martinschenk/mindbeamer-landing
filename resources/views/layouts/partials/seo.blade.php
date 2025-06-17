@php
    $base = 'https://mindbeamer.io';
    $locales = config('languages.available_locales', ['en','de','es','zh_CN']);

    // Mapping: canonical page key -> locale -> slug
    $slugTranslations = [
        '' => [
            'en' => '',
            'de' => '',
            'es' => '',
            'zh_CN' => '',
        ],
        'privacy-policy' => [
            'en' => 'privacy-policy',
            'de' => 'datenschutz-richtlinie',
            'es' => 'politica-privacidad',
            'zh_CN' => 'privacy-policy',
        ],
        'impressum' => [
            'en' => 'legal-notice',
            'de' => 'impressum',
            'es' => 'aviso-legal',
            'zh_CN' => 'legal-notice',
        ],
        'terms' => [
            'en' => 'terms',
            'de' => 'agb',
            'es' => 'terminos',
            'zh_CN' => 'terms',
        ],
    ];

    $pageKey = $pageKey ?? '';
    $currentLocale = app()->getLocale();
    $slugForLocale = $slugTranslations[$pageKey][$currentLocale] ?? $pageKey;
    $canonical = rtrim($base, '/') . '/' . $currentLocale . ($slugForLocale ? '/' . $slugForLocale : '');
@endphp

        <!-- Canonical URL -->
<link rel="canonical" href="{{ $canonical }}">

<!-- hreflang alternate links -->
@foreach($locales as $loc)
    @php
        $slug = $slugTranslations[$pageKey][$loc] ?? $pageKey;
        $url  = rtrim($base, '/') . '/' . $loc . ($slug ? '/' . $slug : '');
    @endphp
    <link rel="alternate" hreflang="{{ $loc }}" href="{{ $url }}">
@endforeach
<link rel="alternate" hreflang="x-default"
      href="{{ rtrim($base, '/') . '/en' . ($slugTranslations[$pageKey]['en'] ? '/' . $slugTranslations[$pageKey]['en'] : '') }}">

<!-- Robots -->
<meta name="robots" content="index,follow">

<!-- Open Graph -->
<meta property="og:title"
      content="@yield('og_title', trim(View::hasSection('title') ? View::yieldContent('title') : 'MindBeamer'))">
<meta property="og:description" content="@yield('og_description', __('messages.hero_subtitle'))">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:site_name" content="MindBeamer">
<meta property="og:locale" content="{{ str_replace('_', '-', $currentLocale) }}">
<meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title"
      content="@yield('twitter_title', trim(View::hasSection('title') ? View::yieldContent('title') : 'MindBeamer'))">
<meta name="twitter:description" content="@yield('twitter_description', __('messages.hero_subtitle'))">
<meta name="twitter:image" content="@yield('twitter_image', asset('images/og-default.jpg'))">
