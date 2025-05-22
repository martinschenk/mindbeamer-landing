<?php

/**
 * Gets the current locale from the session or sets default to 'en'
 *
 * @return string Current locale code
 */
function getCurrentLocale() {
    return app()->getLocale();
}

/**
 * Sets the current locale in the session
 *
 * @param string $locale Locale code (e.g., 'en', 'de')
 * @return void
 */
function setAppLocale($locale) {
    $supportedLocales = config('languages.available_locales', ['en', 'de']);
    
    if (in_array($locale, $supportedLocales)) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
}

// Don't redefine the __ function if it already exists (Laravel provides it)
if (!function_exists('__')) {
    /**
     * Translates a string based on the current locale
     *
     * @param string $key Translation key
     * @param array $replace Values to replace in the translation
     * @param string|null $locale Override the current locale
     * @return string
     */
    function __($key, $replace = [], $locale = null) {
        // Use Laravel's built-in translation function
        return trans($key, $replace, $locale);
    }
}

/**
 * Get the URL for the current page with a specific locale
 *
 * @param string $locale Locale code
 * @return string URL with locale parameter
 */
function getLocaleUrl($locale) {
    return url()->current() . '?locale=' . $locale;
}

/**
 * Check if the current locale is the specified one
 *
 * @param string $locale Locale code to check
 * @return bool
 */
function isCurrentLocale($locale) {
    return getCurrentLocale() === $locale;
}
