<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Config;

/**
 * Service for managing application locales and language information
 * Uses the existing config/languages.php configuration
 *
 * @package App\Services
 */
class LocaleService
{
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
     * Get display name for a locale
     *
     * @param string $locale
     * @return string
     */
    public function getDisplayName(string $locale): string
    {
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
        $localeFlags = Config::get('languages.locale_flags', []);
        return $localeFlags[$locale] ?? '🏳️';
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

    /**
     * Get the default locale
     *
     * @return string
     */
    public function getDefaultLocale(): string
    {
        return Config::get('languages.default_locale', 'en');
    }

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
