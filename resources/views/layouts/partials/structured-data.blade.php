@php
    $currentLocale = app()->getLocale();
    $baseUrl = 'https://mindbeamer.io';
    $pageKey = $pageKey ?? '';
    
    // URL-Struktur für verschiedene Seiten
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
    
    $slugForLocale = $slugTranslations[$pageKey][$currentLocale] ?? $pageKey;
    $currentUrl = rtrim($baseUrl, '/') . '/' . $currentLocale . ($slugForLocale ? '/' . $slugForLocale : '');
@endphp

<!-- JSON-LD Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Organization",
      "@id": "{{ $baseUrl }}/#organization",
      "name": "MindBeamer",
      "url": "{{ $baseUrl }}",
      "logo": {
        "@type": "ImageObject",
        "url": "{{ $baseUrl }}/images/mindbeamer-logo.png",
        "width": 300,
        "height": 100
      },
      "description": "{{ __('messages.hero_subtitle') }}",
      "foundingDate": "2024",
      "sameAs": [
        "https://twitter.com/mindbeamer",
        "https://linkedin.com/company/mindbeamer"
      ],
      "contactPoint": {
        "@type": "ContactPoint",
        "contactType": "customer service",
        "availableLanguage": ["English", "German", "Spanish", "Chinese"]
      }
    },
    {
      "@type": "WebSite",
      "@id": "{{ $baseUrl }}/#website",
      "url": "{{ $baseUrl }}",
      "name": "MindBeamer",
      "description": "{{ __('messages.hero_subtitle') }}",
      "publisher": {
        "@id": "{{ $baseUrl }}/#organization"
      },
      "inLanguage": [
        {
          "@type": "Language",
          "name": "English",
          "alternateName": "en"
        },
        {
          "@type": "Language", 
          "name": "German",
          "alternateName": "de"
        },
        {
          "@type": "Language",
          "name": "Spanish", 
          "alternateName": "es"
        },
        {
          "@type": "Language",
          "name": "Chinese",
          "alternateName": "zh_CN"
        }
      ],
      "potentialAction": {
        "@type": "SearchAction",
        "target": {
          "@type": "EntryPoint",
          "urlTemplate": "{{ $baseUrl }}/{{ $currentLocale }}?q={search_term_string}"
        },
        "query-input": "required name=search_term_string"
      }
    },
    {
      "@type": "WebPage",
      "@id": "{{ $currentUrl }}#webpage",
      "url": "{{ $currentUrl }}",
      "name": "@yield('title', 'MindBeamer - ' . __('messages.hero_title'))",
      "description": "@yield('meta_description', __('messages.hero_subtitle'))",
      "inLanguage": "{{ $currentLocale }}",
      "isPartOf": {
        "@id": "{{ $baseUrl }}/#website"
      },
      "about": {
        "@id": "{{ $baseUrl }}/#organization"
      },
      "datePublished": "2024-01-01",
      "dateModified": "{{ date('Y-m-d') }}"
    }
    @if($pageKey === '')
    ,{
      "@type": "BreadcrumbList",
      "@id": "{{ $currentUrl }}#breadcrumb",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "{{ __('messages.home') }}",
          "item": "{{ $currentUrl }}"
        }
      ]
    }
    @else
    ,{
      "@type": "BreadcrumbList", 
      "@id": "{{ $currentUrl }}#breadcrumb",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "{{ __('messages.home') }}",
          "item": "{{ rtrim($baseUrl, '/') . '/' . $currentLocale }}"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "@yield('title', ucfirst($pageKey))",
          "item": "{{ $currentUrl }}"
        }
      ]
    }
    @endif
  ]
}
</script>