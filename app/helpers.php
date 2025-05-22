<?php

/**
 * Gets the current locale from the session or sets default to 'en'
 *
 * @return string Current locale code
 */
function getCurrentLocale() {
    if (!isset($_SESSION['locale'])) {
        $_SESSION['locale'] = 'en';
    }
    
    return $_SESSION['locale'];
}

/**
 * Sets the current locale in the session
 *
 * @param string $locale Locale code (e.g., 'en', 'de')
 * @return void
 */
function setAppLocale($locale) {
    $supportedLocales = ['en', 'de'];
    
    if (in_array($locale, $supportedLocales)) {
        $_SESSION['locale'] = $locale;
    }
}

/**
 * Translates a string based on the current locale
 *
 * @param string $key Translation key
 * @param array $replace Values to replace in the translation
 * @param string|null $locale Override the current locale
 * @return string
 */
function __($key, $replace = [], $locale = null) {
    $locale = $locale ?: getCurrentLocale();
    
    $path = __DIR__ . '/lang/' . $locale . '/messages.php';
    
    if (!file_exists($path)) {
        $path = __DIR__ . '/lang/en/messages.php'; // Fallback to English
    }
    
    $translations = include $path;
    
    // If translation doesn't exist in current locale, try English as fallback
    if (!isset($translations[$key]) && $locale !== 'en') {
        $fallbackPath = __DIR__ . '/lang/en/messages.php';
        if (file_exists($fallbackPath)) {
            $fallbackTranslations = include $fallbackPath;
            $translation = $fallbackTranslations[$key] ?? $key;
        } else {
            $translation = $key;
        }
    } else {
        $translation = $translations[$key] ?? $key;
    }
    
    if (!empty($replace)) {
        foreach ($replace as $k => $value) {
            $translation = str_replace(':' . $k, $value, $translation);
        }
    }
    
    return $translation;
}

/**
 * Get the URL for the current page with a specific locale
 *
 * @param string $locale Locale code
 * @return string URL with locale parameter
 */
function getLocaleUrl($locale) {
    $currentUrl = $_SERVER['REQUEST_URI'];
    $parsedUrl = parse_url($currentUrl);
    
    $query = [];
    if (isset($parsedUrl['query'])) {
        parse_str($parsedUrl['query'], $query);
    }
    
    $query['locale'] = $locale;
    
    $newQuery = http_build_query($query);
    
    return $parsedUrl['path'] . '?' . $newQuery;
}

/**
 * Check if the current locale is the specified one
 * 
 * @param string $locale Locale to check against
 * @return bool
 */
function isCurrentLocale($locale) {
    return getCurrentLocale() === $locale;
}
