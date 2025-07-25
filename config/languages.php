<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Available Locales
    |--------------------------------------------------------------------------
    |
    | This array contains the locales that are available for the application.
    | Each locale is represented by its ISO-639-1 code.
    |
    */
    'available_locales' => [
        'en',
        'de',
        'es',
        'zh_CN',
        'pt_BR',
        'fr',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Locale
    |--------------------------------------------------------------------------
    |
    | The default locale to use when a specific locale is not requested.
    |
    */
    'default_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The locale to fall back to if a translation is not available in the
    | requested locale.
    |
    */
    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Locale Display Names
    |--------------------------------------------------------------------------
    |
    | The display names for each locale in their own language.
    |
    */
    'locale_names' => [
        'en' => 'English',
        'de' => 'Deutsch',
        'es' => 'Español',
        'zh_CN' => '简体中文',
        'pt_BR' => 'Português',
        'fr' => 'Français',
    ],

    /*
    |--------------------------------------------------------------------------
    | Locale Flags
    |--------------------------------------------------------------------------
    |
    | Flag emojis for each supported locale.
    |
    */
    'locale_flags' => [
        'en' => '🇺🇸',
        'de' => '🇩🇪', 
        'es' => '🇪🇸',
        'zh_CN' => '🇨🇳',
        'pt_BR' => '🇧🇷',
        'fr' => '🇫🇷',
    ],
];
