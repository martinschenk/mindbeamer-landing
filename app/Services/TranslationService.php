<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

/**
 * Handles translation and localization functionality
 */
class TranslationService
{
    /**
     * Get the current locale from the session or set default
     *
     * @return string Current locale code
     */
    public function getCurrentLocale(): string
    {
        return App::getLocale();
    }

    /**
     * Sets the current locale in the session
     *
     * @param string $locale Locale code (e.g., 'en', 'de')
     * @return void
     */
    public function setAppLocale(string $locale): void
    {
        $supportedLocales = Config::get('languages.available_locales', ['en', 'de']);
        
        if (in_array($locale, $supportedLocales, true)) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }
    }

    /**
     * Get the URL for the current page with a specific locale
     *
     * @param string $locale Locale code
     * @return string URL with locale parameter
     */
    public function getLocaleUrl(string $locale): string
    {
        $supportedLocales = Config::get('languages.available_locales', ['en', 'de']);
        
        if (!in_array($locale, $supportedLocales, true)) {
            $locale = Config::get('languages.default_locale', 'en');
        }
        
        return url()->current() . '?locale=' . $locale;
    }

    /**
     * Check if the current locale is the specified one
     * 
     * @param string $locale Locale to check against
     * @return bool
     */
    public function isCurrentLocale(string $locale): bool
    {
        return $this->getCurrentLocale() === $locale;
    }

    /**
     * Get list of all available locales with their display names
     *
     * @return array<string, string> Array of locale codes => display names
     */
    public function getAvailableLocales(): array
    {
        return Config::get('languages.locale_names', [
            'en' => 'English',
            'de' => 'Deutsch',
        ]);
    }
}
