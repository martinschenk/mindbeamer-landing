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
    },
    {
      "@type": "FAQPage",
      "@id": "{{ $currentUrl }}#faqpage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "{{ __('messages.objection1_q') }}",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "{{ __('messages.objection1_a') }}"
          }
        },
        {
          "@type": "Question",
          "name": "{{ __('messages.objection2_q') }}",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "{{ __('messages.objection2_a') }}"
          }
        },
        {
          "@type": "Question",
          "name": "{{ __('messages.objection3_q') }}",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "{{ __('messages.objection3_a') }}"
          }
        },
        {
          "@type": "Question",
          "name": "{{ __('messages.objection4_q') }}",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "{{ __('messages.objection4_a') }}"
          }
        },
        {
          "@type": "Question",
          "name": "{{ __('messages.objection5_q') }}",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "{{ __('messages.objection5_a') }}"
          }
        },
        {
          "@type": "Question",
          "name": "{{ __('messages.objection6_q') }}",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "{{ __('messages.objection6_a') }}"
          }
        }
      ]
    },
    {
      "@type": "Product",
      "@id": "{{ $baseUrl }}/#product",
      "name": "MindBeamer AI Content Automation",
      "description": "{{ __('messages.hero_subtitle') }}",
      "brand": {
        "@type": "Brand",
        "name": "MindBeamer"
      },
      "offers": [
        {
          "@type": "Offer",
          "name": "{{ __('messages.pricing_starter_name') }}",
          "description": "{{ __('messages.pricing_starter_desc') }}",
          "price": "0",
          "priceCurrency": "USD",
          "priceValidUntil": "{{ date('Y-12-31') }}",
          "availability": "https://schema.org/InStock",
          "url": "{{ $baseUrl }}/#pricing",
          "itemOffered": {
            "@type": "Service",
            "name": "14-Day Free Trial"
          }
        },
        {
          "@type": "Offer",
          "name": "{{ __('messages.pricing_pro_name') }}",
          "description": "{{ __('messages.pricing_pro_desc') }}",
          "price": "15",
          "priceCurrency": "USD",
          "priceValidUntil": "{{ date('Y-12-31') }}",
          "availability": "https://schema.org/InStock",
          "url": "{{ $baseUrl }}/#pricing",
          "itemOffered": {
            "@type": "Service",
            "name": "Professional Plan"
          }
        },
        {
          "@type": "Offer",
          "name": "{{ __('messages.pricing_enterprise_name') }}",
          "description": "{{ __('messages.pricing_enterprise_desc') }}",
          "price": "0",
          "priceCurrency": "USD",
          "availability": "https://schema.org/InStock",
          "url": "{{ $baseUrl }}/#pricing",
          "priceSpecification": {
            "@type": "UnitPriceSpecification",
            "price": "0",
            "priceCurrency": "USD",
            "referenceQuantity": {
              "@type": "QuantitativeValue",
              "value": "1",
              "unitText": "CUSTOM"
            }
          },
          "itemOffered": {
            "@type": "Service",
            "name": "Enterprise Plan"
          }
        }
      ]
    },
    {
      "@type": "HowTo",
      "@id": "{{ $currentUrl }}#howto",
      "name": "{{ __('messages.how_it_works_title') }}",
      "description": "{{ __('messages.how_it_works_subtitle') }}",
      "totalTime": "PT10M",
      "step": [
        {
          "@type": "HowToStep",
          "position": 1,
          "name": "{{ __('messages.step1_title') }}",
          "text": "{{ __('messages.step1_point1') }} {{ __('messages.step1_point2') }} {{ __('messages.step1_point3') }}",
          "url": "{{ $baseUrl }}/#how-it-works"
        },
        {
          "@type": "HowToStep",
          "position": 2,
          "name": "{{ __('messages.step2_title') }}",
          "text": "{{ __('messages.step2_point1') }} {{ __('messages.step2_point2') }} {{ __('messages.step2_point3') }}",
          "url": "{{ $baseUrl }}/#how-it-works"
        },
        {
          "@type": "HowToStep",
          "position": 3,
          "name": "{{ __('messages.step3_title') }}",
          "text": "{{ __('messages.step3_point1') }} {{ __('messages.step3_point2') }} {{ __('messages.step3_point3') }}",
          "url": "{{ $baseUrl }}/#how-it-works"
        }
      ]
    },
    {
      "@type": "SiteNavigationElement",
      "@id": "{{ $baseUrl }}/#navigation",
      "name": "Main Navigation",
      "hasPart": [
        {
          "@type": "WebPageElement",
          "name": "{{ __('messages.nav_how_it_works') }}",
          "url": "{{ $baseUrl }}/#how-it-works"
        },
        {
          "@type": "WebPageElement",
          "name": "{{ __('messages.nav_features') }}",
          "url": "{{ $baseUrl }}/#features"
        },
        {
          "@type": "WebPageElement",
          "name": "{{ __('messages.nav_why_us') }}",
          "url": "{{ $baseUrl }}/#problem"
        },
        {
          "@type": "WebPageElement",
          "name": "Pricing",
          "url": "{{ $baseUrl }}/#pricing"
        }
      ]
    },
    {
      "@type": "LocalBusiness",
      "@id": "{{ $baseUrl }}/#localbusiness",
      "name": "MindBeamer - Martin Schenk S.L.",
      "description": "{{ __('messages.hero_subtitle') }}",
      "url": "{{ $baseUrl }}",
      "telephone": "+34-669-686-832",
      "email": "m.schenk@mindbeamer.io",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Calle Claudio Coello 14, 5G",
        "addressLocality": "Madrid",
        "postalCode": "28001",
        "addressCountry": "ES"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "40.4234",
        "longitude": "-3.6883"
      },
      "openingHours": "Mo-Fr 09:00-18:00",
      "sameAs": [
        "https://twitter.com/mindbeamer",
        "https://linkedin.com/company/mindbeamer"
      ]
    },
    {
      "@type": "Service",
      "@id": "{{ $baseUrl }}/#service",
      "serviceType": "AI Content Automation for Social Media",
      "provider": {
        "@id": "{{ $baseUrl }}/#organization"
      },
      "areaServed": {
        "@type": "Place",
        "name": "Worldwide"
      },
      "availableChannel": {
        "@type": "ServiceChannel",
        "serviceUrl": "{{ $baseUrl }}",
        "serviceType": "Online Service"
      },
      "offers": {
        "@id": "{{ $baseUrl }}/#product"
      },
      "category": "Business Automation",
      "audience": {
        "@type": "BusinessAudience",
        "audienceType": "Small and Medium Business Owners"
      }
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