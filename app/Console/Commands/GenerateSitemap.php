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

        // Get slug translations from LocalizedUrlHelper to ensure consistency
        // This eliminates duplication and ensures sitemap URLs match actual site URLs
        $slugTranslations = LocalizedUrlHelper::getSlugTranslations();
        
        // Add home page to translations
        $slugTranslations[''] = [
            'en' => '',
            'de' => '',
            'es' => '',
            'zh_CN' => '',
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

        // Force production domain regardless of local config; adjust if option provided later.
        $baseUrl = 'https://mindbeamer.io';
        $now = Carbon::now()->toAtomString();

        $xml = [];
        $xml[] = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" ' .
            'xmlns:xhtml="http://www.w3.org/1999/xhtml" ' .
            'xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
        
        // Add root URL first with highest priority
        // This is crucial for SEO - the root domain serves English content without redirects
        // and acts as the x-default for international/unknown visitors
        $xml[] = '  <url>';
        $xml[] = '    <loc>' . e($baseUrl) . '</loc>';
        $xml[] = '    <lastmod>' . $now . '</lastmod>';
        $xml[] = '    <changefreq>weekly</changefreq>';
        $xml[] = '    <priority>1.0</priority>';  // Highest priority for root domain
        
        // Add hreflang links for all languages
        foreach ($locales as $locale) {
            $xml[] = '    <xhtml:link rel="alternate" hreflang="' . $locale . '" href="' . e($baseUrl . '/' . $locale) . '" />';
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

        foreach ($pageKeys as $slugPart) {
            foreach ($locales as $locale) {
                $slug = $slugTranslations[$slugPart][$locale] ?? $slugPart;
                $loc = rtrim($baseUrl, '/') . '/' . $locale . ($slug ? '/' . $slug : '');

                $xml[] = '  <url>';
                $xml[] = '    <loc>' . e($loc) . '</loc>';
                $xml[] = '    <lastmod>' . $now . '</lastmod>';
                $xml[] = '    <changefreq>weekly</changefreq>';
                $xml[] = '    <priority>0.8</priority>';

                // Alternate links for the same route in all locales
                foreach ($locales as $altLocale) {
                    $altSlug = $slugTranslations[$slugPart][$altLocale] ?? $slugPart;
                    $altUrl = rtrim($baseUrl, '/') . '/' . $altLocale . ($altSlug ? '/' . $altSlug : '');
                    $xml[] = '    <xhtml:link rel="alternate" hreflang="' . $altLocale . '" href="' . e(
                            $altUrl,
                        ) . '" />';
                }
                
                // Add x-default hreflang - critical for international SEO
                if ($slugPart === '') {
                    // For home page, x-default points to root domain (mindbeamer.io)
                    // This tells Google that the root domain is the default for unknown languages
                    $xml[] = '    <xhtml:link rel="alternate" hreflang="x-default" href="' . e($baseUrl) . '" />';
                } else {
                    // For other pages (privacy, terms, etc), x-default points to English version
                    // since we don't serve these pages on the root domain
                    $defaultSlug = $slugTranslations[$slugPart]['en'] ?? $slugPart;
                    $defaultUrl = rtrim($baseUrl, '/') . '/en' . ($defaultSlug ? '/' . $defaultSlug : '');
                    $xml[] = '    <xhtml:link rel="alternate" hreflang="x-default" href="' . e($defaultUrl) . '" />';
                }

                // Add images for this page if available
                if (isset($pageImages[$slugPart]) && !empty($pageImages[$slugPart])) {
                    foreach ($pageImages[$slugPart] as $imageUrl) {
                        $xml[] = '    <image:image>';
                        $xml[] = '      <image:loc>' . e($imageUrl) . '</image:loc>';
                        $xml[] = '      <image:caption>MindBeamer - Autonomous AI Content Creation</image:caption>';
                        $xml[] = '    </image:image>';
                    }
                }

                $xml[] = '  </url>';
            }
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
