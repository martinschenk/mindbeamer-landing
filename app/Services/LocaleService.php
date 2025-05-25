<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

/**
 * Service for managing application locales and language information
 * Uses the existing config/languages.php configuration
 *
 * @package App\Services
 */
class LocaleService
{
    /**
     * Constants for Chinese locale formats
     */
    public const CHINESE_UNDERSCORE = 'zh_CN';
    public const CHINESE_HYPHEN = 'zh-CN';
    
    /**
     * Get all available locales from configuration
     *
     * @return array<string>
     */
    public function getAvailableLocales(): array
    {
        return Config::get('languages.available_locales', []);
    }

    /**
     * Get the default locale from configuration
     *
     * @return string
     */
    public function getDefaultLocale(): string
    {
        return Config::get('languages.default_locale', 'en');
    }
    
    /**
     * Get display name for a locale
     *
     * @param string $locale
     * @return string
     */
    public function getDisplayName(string $locale): string
    {
        // Standardize Chinese format for lookups
        if ($locale === self::CHINESE_HYPHEN) {
            $locale = self::CHINESE_UNDERSCORE;
        }
        
        $localeNames = Config::get('languages.locale_names', []);
        return $localeNames[$locale] ?? 'Unknown';
    }

    /**
     * Get flag emoji for a locale
     *
     * @param string $locale
     * @return string
     */
    public function getFlag(string $locale): string
    {
        // Standardize Chinese format for lookups
        if ($locale === self::CHINESE_HYPHEN) {
            $locale = self::CHINESE_UNDERSCORE;
        }
        
        $localeFlags = Config::get('languages.locale_flags', []);
        return $localeFlags[$locale] ?? '🏳️';
    }
    
    /**
     * Normalize locale format - critical for Chinese locale handling
     * This ensures consistent handling across the application
     *
     * @param string $locale
     * @return string
     */
    public function normalizeLocale(string $locale): string
    {
        // Special handling for Chinese locale
        if ($locale === self::CHINESE_HYPHEN) {
            return self::CHINESE_UNDERSCORE;
        }
        
        return $locale;
    }
    
    /**
     * Enforces the current locale and ensures it stays consistent
     * This is a critical method for fixing the Chinese locale issue
     *
     * @param string|null $locale Optional locale to set
     * @return string The current active locale
     */
    public function enforceLocale(?string $locale = null): string
    {
        // If no locale specified, use current session locale
        if ($locale === null) {
            $locale = Session::get('locale');
            
            // If no session locale, use default
            if (!$locale) {
                $locale = $this->getDefaultLocale();
            }
        }
        
        // Normalize the locale (especially important for Chinese)
        $locale = $this->normalizeLocale($locale);
        
        // Check if locale is supported
        $supportedLocales = $this->getAvailableLocales();
        if (!in_array($locale, $supportedLocales, true)) {
            $locale = $this->getDefaultLocale();
            Log::info("Locale '{$locale}' not supported, using default instead");
        }
        
        // Set the locale in all necessary places
        App::setLocale($locale);
        Config::set('app.locale', $locale);
        Session::put('locale', $locale);
        
        // Force session save
        Session::save();
        
        return $locale;
    }
    
    /**
     * Get properly formatted HTML lang attribute
     * This is critical for rendering the correct locale in HTML
     *
     * @param string|null $locale Optional locale to convert
     * @return string
     */
    public function getHtmlLangAttribute(?string $locale = null): string
    {
        if ($locale === null) {
            $locale = App::getLocale();
        }
        
        // Special handling for Chinese - ALWAYS use hyphen format for HTML
        if ($locale === self::CHINESE_UNDERSCORE) {
            return self::CHINESE_HYPHEN;
        }
        
        // Standard handling for other locales
        return str_replace('_', '-', $locale);
    }

    /**
     * Get formatted display string with flag for a locale
     *
     * @param string $locale
     * @return string
     */
    public function getFormattedDisplayName(string $locale): string
    {
        return sprintf(
            '%s %s',
            $this->getDisplayName($locale),
            $this->getFlag($locale)
        );
    }

    /**
     * Check if a locale is supported
     *
     * @param string $locale
     * @return bool
     */
    public function isSupported(string $locale): bool
    {
        return in_array($locale, $this->getAvailableLocales(), true);
    }

    // Diese Methode wurde nach oben verschoben und steht jetzt über getDisplayName

    /**
     * Get the fallback locale
     *
     * @return string
     */
    public function getFallbackLocale(): string
    {
        return Config::get('languages.fallback_locale', 'en');
    }

    /**
     * Validate and sanitize locale, return fallback if invalid
     *
     * @param string $locale
     * @return string
     */
    public function sanitizeLocale(string $locale): string
    {
        return $this->isSupported($locale) ? $locale : $this->getFallbackLocale();
    }
}
