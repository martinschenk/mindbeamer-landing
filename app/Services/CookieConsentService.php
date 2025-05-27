<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\App;

/**
 * Service für das Cookie-Consent-Management
 */
class CookieConsentService
{
    /**
     * Die aktuelle Sprach-Locale
     *
     * @var string
     */
    protected string $currentLocale;

    /**
     * Konstruktor
     */
    public function __construct()
    {
        $this->currentLocale = App::getLocale();
    }

    /**
     * Gibt die Übersetzung für einen Consent-Key zurück
     *
     * @param string $key Der Übersetzungsschlüssel
     * @return string Die übersetzte Nachricht
     */
    public function trans(string $key): string
    {
        return __("cookie-consent.{$key}");
    }

    /**
     * Gibt die Cookie-Kategorien zurück
     *
     * @return array Array mit Cookie-Kategorien und deren Eigenschaften
     */
    public function getCookieCategories(): array
    {
        return [
            'essential' => [
                'title' => $this->trans('essential_title'),
                'description' => $this->trans('essential_description'),
                'required' => true,
                'default' => true,
                'key' => 'essential'
            ],
            'analytics' => [
                'title' => $this->trans('analytics_title'),
                'description' => $this->trans('analytics_description'),
                'required' => false,
                'default' => false,
                'key' => 'analytics'
            ],
            'preferences' => [
                'title' => $this->trans('preferences_title'),
                'description' => $this->trans('preferences_description'),
                'required' => false,
                'default' => true,
                'key' => 'preferences'
            ]
        ];
    }

    /**
     * Prüft, ob eine bestimmte Cookie-Kategorie erforderlich ist
     *
     * @param string $category Die zu prüfende Kategorie
     * @return bool True, wenn die Kategorie erforderlich ist
     */
    public function isCategoryRequired(string $category): bool
    {
        $categories = $this->getCookieCategories();
        return isset($categories[$category]) && $categories[$category]['required'];
    }

    /**
     * Gibt die Standard-Einstellung für eine Kategorie zurück
     *
     * @param string $category Die Kategorie
     * @return bool Die Standard-Einstellung (true = aktiviert)
     */
    public function getDefaultForCategory(string $category): bool
    {
        $categories = $this->getCookieCategories();
        return isset($categories[$category]) ? $categories[$category]['default'] : false;
    }

    /**
     * Gibt das JavaScript-Konfigurationsobjekt für den Cookie-Consent zurück
     *
     * @return array Die JavaScript-Konfiguration
     */
    public function getJsConfig(): array
    {
        return [
            'cookieLifetime' => 365,
            'rejectLifetime' => 30,
            'cookiePrefix' => 'mb',
            'categories' => $this->getCookieCategories(),
            'texts' => [
                'bannerTitle' => $this->trans('banner_title'),
                'bannerDescription' => $this->trans('banner_description'),
                'acceptAll' => $this->trans('accept_all'),
                'rejectAll' => $this->trans('reject_all'),
                'settings' => $this->trans('settings'),
                'close' => $this->trans('close'),
                'saveSettings' => $this->trans('save_settings'),
                'active' => $this->trans('active'),
                'inactive' => $this->trans('inactive'),
                'settingsSaved' => $this->trans('settings_saved'),
                'preferencesReset' => $this->trans('preferences_reset')
            ]
        ];
    }
}
