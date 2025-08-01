<?php

declare(strict_types=1);

namespace App\Helpers;

/**
 * LocalizedUrlHelper - Zentrale Verwaltung für mehrsprachige URLs
 * 
 * Diese Klasse stellt sicher, dass alle Links auf der Website die korrekten
 * übersetzten URLs verwenden. Die URL-Struktur wird hier zentral definiert,
 * um Konsistenz zwischen Sitemap.xml und den tatsächlichen Links zu gewährleisten.
 * 
 * Beispiel:
 * - Deutsch: /de/datenschutz-richtlinie statt /de/privacy-policy
 * - Spanisch: /es/politica-privacidad statt /es/privacy-policy
 * 
 * @since v2.1.0
 */
class LocalizedUrlHelper
{
    /**
     * Get slug translations for all pages
     * 
     * Definiert die URL-Slugs für jede Sprache. Diese Mappings müssen
     * mit den Routes in web.php und der Sitemap-Generierung übereinstimmen.
     * 
     * Chinesisch (zh_CN) verwendet die englischen Begriffe als Fallback,
     * da chinesische URLs in lateinischen Zeichen problematisch sein können.
     */
    public static function getSlugTranslations(): array
    {
        return [
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
    }

    /**
     * Get localized URL for a given page
     * 
     * Generiert die vollständige URL für eine Seite in der gewünschten Sprache.
     * Falls keine Sprache angegeben wird, wird die aktuelle App-Locale verwendet.
     * 
     * @param string $page Der Seitentyp (z.B. 'privacy-policy', 'impressum', 'terms')
     * @param string|null $locale Die gewünschte Sprache (optional)
     * @return string Die vollständige lokalisierte URL
     */
    public static function localizedRoute(string $page, ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $translations = self::getSlugTranslations();
        
        if (isset($translations[$page][$locale])) {
            $slug = $translations[$page][$locale];
            return url("/{$locale}/{$slug}");
        }
        
        // Fallback to original page name
        return url("/{$locale}/{$page}");
    }

    /**
     * Get privacy policy URL for current locale
     */
    public static function privacyUrl(?string $locale = null): string
    {
        return self::localizedRoute('privacy-policy', $locale);
    }

    /**
     * Get impressum URL for current locale
     */
    public static function impressumUrl(?string $locale = null): string
    {
        return self::localizedRoute('impressum', $locale);
    }

    /**
     * Get terms URL for current locale
     */
    public static function termsUrl(?string $locale = null): string
    {
        return self::localizedRoute('terms', $locale);
    }

    /**
     * Get the current page type based on the current route
     * 
     * Erkennt den aktuellen Seitentyp anhand der URL. Diese Funktion ist wichtig
     * für den Language Switcher, damit beim Sprachwechsel die richtige Seite
     * in der neuen Sprache angezeigt wird.
     * 
     * @return string|null Der erkannte Seitentyp oder null bei unbekannten Seiten
     */
    public static function getCurrentPageType(): ?string
    {
        $currentPath = request()->path();
        $segments = explode('/', $currentPath);
        
        // Remove locale from path
        if (count($segments) > 1) {
            array_shift($segments);
        }
        
        $slug = implode('/', $segments);
        
        // Map all possible slugs to their page types
        $slugMap = [
            '' => 'home',
            'privacy-policy' => 'privacy-policy',
            'datenschutz-richtlinie' => 'privacy-policy',
            'politica-privacidad' => 'privacy-policy',
            'politica-privacidade' => 'privacy-policy',
            'politique-confidentialite' => 'privacy-policy',
            'gizla-niti' => 'privacy-policy',
            'legal-notice' => 'impressum',
            'impressum' => 'impressum',
            'aviso-legal' => 'impressum',
            'mentions-legales' => 'impressum',
            'vidhi-suchna' => 'impressum',
            'terms' => 'terms',
            'agb' => 'terms',
            'terminos' => 'terms',
            'termos' => 'terms',
            'conditions' => 'terms',
            'sharten' => 'terms',
        ];
        
        return $slugMap[$slug] ?? null;
    }

    /**
     * Get localized URL for current page in a different locale
     * 
     * Diese Methode wird vom Language Switcher verwendet, um die aktuelle Seite
     * in einer anderen Sprache anzuzeigen. Sie erkennt automatisch die aktuelle
     * Seite und generiert die korrekte übersetzte URL.
     * 
     * @param string $locale Die Zielsprache
     * @return string Die URL der aktuellen Seite in der Zielsprache
     */
    public static function currentPageInLocale(string $locale): string
    {
        $pageType = self::getCurrentPageType();
        
        if ($pageType === 'home') {
            return url("/{$locale}");
        }
        
        if ($pageType && isset(self::getSlugTranslations()[$pageType])) {
            return self::localizedRoute($pageType, $locale);
        }
        
        // Fallback for unknown pages
        return url("/{$locale}");
    }
}