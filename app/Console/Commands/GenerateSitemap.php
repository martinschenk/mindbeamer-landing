<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use App\Helpers\LocalizedUrlHelper;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an SEO-friendly sitemap.xml covering all languages and pages.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Generating sitemap…');

        $locales = config('languages.available_locales', ['en']);
        $defaultLocale = config('languages.default_locale', 'en');
        
        // Map internal locale codes to proper hreflang codes
        $hreflangMap = [
            'en' => 'en',
            'de' => 'de',
            'es' => 'es',
            'zh_CN' => 'zh-CN',  // Convert underscore to hyphen for hreflang
            'pt_BR' => 'pt-BR',  // Convert underscore to hyphen for hreflang
            'fr' => 'fr',
            'hi' => 'hi',
        ];

        // Get slug translations from LocalizedUrlHelper to ensure consistency
        // This eliminates duplication and ensures sitemap URLs match actual site URLs
        $slugTranslations = LocalizedUrlHelper::getSlugTranslations();
        
        // Add home page to translations - all languages have the same empty slug for home
        $slugTranslations[''] = [
            'en' => '',
            'de' => '',
            'es' => '',
            'zh_CN' => '',
            'pt_BR' => '',
            'fr' => '',
            'hi' => '',
        ];

        // Define static page keys we want to include
        $pageKeys = ['', 'privacy-policy', 'impressum', 'terms'];
        
        // Define images for each page (optional SEO enhancement)
        $pageImages = [
            '' => [
                'https://mindbeamer.io/images/hero-dashboard.png',
                'https://mindbeamer.io/images/features-preview.png'
            ],
            'privacy-policy' => [],
            'impressum' => [],
            'terms' => []
        ];
        
        // Define priorities for different pages (SEO optimization)
        $priorities = [
            '' => '1.0',              // Home page - highest priority
            'privacy-policy' => '0.5', // Legal pages - lower priority
            'impressum' => '0.5',
            'terms' => '0.5',
        ];
        
        // Define change frequencies based on page type
        $changeFreqs = [
            '' => 'daily',            // Home page changes frequently
            'privacy-policy' => 'monthly', // Legal pages change rarely
            'impressum' => 'yearly',
            'terms' => 'monthly',
        ];

        // Force production domain regardless of local config; adjust if option provided later.
        $baseUrl = 'https://mindbeamer.io';
        $now = Carbon::now()->toAtomString();

        $xml = [];
        $xml[] = '<?xml version="1.0" encoding="UTF-8"?>';
        // Added XSL stylesheet reference for human-readable display in browsers
        // The sitemap.xsl file transforms the XML into a formatted HTML table
        // This has no impact on search engines - they read the raw XML
        $xml[] = '<?xml-stylesheet type="text/xsl" href="/sitemap.xsl"?>';
        $xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" ' .
            'xmlns:xhtml="http://www.w3.org/1999/xhtml" ' .
            'xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
        
        // Add root URL first with highest priority
        // This is crucial for SEO - the root domain serves English content without redirects
        // and acts as the x-default for international/unknown visitors
        $xml[] = '  <url>';
        $xml[] = '    <loc>' . e($baseUrl) . '</loc>';
        $xml[] = '    <lastmod>' . $now . '</lastmod>';
        $xml[] = '    <changefreq>daily</changefreq>';
        $xml[] = '    <priority>1.0</priority>';  // Highest priority for root domain
        
        // Add hreflang links for all languages
        foreach ($locales as $locale) {
            $hreflangCode = $hreflangMap[$locale] ?? $locale;
            // English points to root domain (SEO strategy: root = English)
            $hreflangUrl = ($locale === 'en') ? $baseUrl : $baseUrl . '/' . $locale;
            $xml[] = '    <xhtml:link rel="alternate" hreflang="' . $hreflangCode . '" href="' . e($hreflangUrl) . '" />';
        }
        $xml[] = '    <xhtml:link rel="alternate" hreflang="x-default" href="' . e($baseUrl) . '" />';
        
        // Add images for root page
        if (isset($pageImages[''])) {
            foreach ($pageImages[''] as $imageUrl) {
                $xml[] = '    <image:image>';
                $xml[] = '      <image:loc>' . e($imageUrl) . '</image:loc>';
                $xml[] = '      <image:caption>MindBeamer - Autonomous AI Content Creation</image:caption>';
                $xml[] = '    </image:image>';
            }
        }
        
        $xml[] = '  </url>';

        // Add all other pages - ONLY canonical URLs (English without /en prefix)
        // hreflang links point to all language versions, but only the canonical URL is in <loc>
        foreach ($pageKeys as $slugPart) {
            if ($slugPart === '') {
                continue; // Skip homepage, already handled above
            }

            // Use English slug as the canonical URL (without /en prefix)
            $slug = $slugTranslations[$slugPart]['en'] ?? $slugPart;
            $loc = rtrim($baseUrl, '/') . '/' . $slug;
            $priority = $priorities[$slugPart] ?? '0.8';
            $changeFreq = $changeFreqs[$slugPart] ?? 'weekly';

            $xml[] = '  <url>';
            $xml[] = '    <loc>' . e($loc) . '</loc>';
            $xml[] = '    <lastmod>' . $now . '</lastmod>';
            $xml[] = '    <changefreq>' . $changeFreq . '</changefreq>';
            $xml[] = '    <priority>' . $priority . '</priority>';

            // Add hreflang links for all languages
            foreach ($locales as $altLocale) {
                $altSlug = $slugTranslations[$slugPart][$altLocale] ?? $slugPart;
                if ($altLocale === 'en') {
                    $altUrl = rtrim($baseUrl, '/') . '/' . $altSlug;
                } else {
                    $altUrl = rtrim($baseUrl, '/') . '/' . $altLocale . '/' . $altSlug;
                }
                $hreflangCode = $hreflangMap[$altLocale] ?? $altLocale;
                $xml[] = '    <xhtml:link rel="alternate" hreflang="' . $hreflangCode . '" href="' . e($altUrl) . '" />';
            }

            // x-default points to English version at root
            $xml[] = '    <xhtml:link rel="alternate" hreflang="x-default" href="' . e($loc) . '" />';

            $xml[] = '  </url>';
        }

        $xml[] = '</urlset>';

        // Save directly into the public directory so it is reachable under /sitemap.xml
        $publicPath = public_path('sitemap.xml');

        // Ensure directory exists (should for Laravel default), then write file
        file_put_contents($publicPath, implode("\n", $xml));

        // Remove any legacy sitemap that might still live in storage/app/public to avoid confusion
        $legacyPath = storage_path('app/public/sitemap.xml');
        if (file_exists($legacyPath)) {
            @unlink($legacyPath);
        }

        $this->info('Sitemap generated at ' . $publicPath);

        return self::SUCCESS;
    }
}
