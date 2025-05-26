<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\MarketingConsent;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

/**
 * Service für mehrsprachige Cookie Consent Konfiguration
 * 
 * Dieser Service stellt lokalisierte Cookie Consent Konfigurationen
 * für alle unterstützten Sprachen bereit (DE, EN, ES) und verwaltet
 * Marketing-Einwilligungen gemäß DSGVO-Richtlinien.
 */
class CookieConsentService
{
    /**
     * Gibt die komplette Cookie Consent Konfiguration für die aktuelle Sprache zurück
     *
     * @return array
     */
    public function getLocalizedConfig(): array
    {
        $locale = App::getLocale();
        
        return [
            'cookie_lifetime' => config('laravel-cookie-consent.cookie_lifetime', 365),
            'reject_lifetime' => config('laravel-cookie-consent.reject_lifetime', 30),
            'disable_page_interaction' => config('laravel-cookie-consent.disable_page_interaction', false),
            'preferences_modal_enabled' => config('laravel-cookie-consent.preferences_modal_enabled', true),
            'consent_modal_layout' => config('laravel-cookie-consent.consent_modal_layout', 'bar'),
            'flip_button' => config('laravel-cookie-consent.flip_button', true),
            'theme' => config('laravel-cookie-consent.theme', 'custom'),
            'cookie_prefix' => config('laravel-cookie-consent.cookie_prefix', 'MindBeamer'),
            'policy_links' => $this->getLocalizedPolicyLinks(),
            'cookie_categories' => $this->getLocalizedCategories(),
            'cookie_title' => __('cookie-consent.cookie_title'),
            'cookie_description' => __('cookie-consent.cookie_description'),
            'cookie_modal_title' => __('cookie-consent.cookie_modal_title'),
            'cookie_modal_intro' => __('cookie-consent.cookie_modal_intro'),
            'cookie_accept_btn_text' => __('cookie-consent.cookie_accept_btn_text'),
            'cookie_reject_btn_text' => __('cookie-consent.cookie_reject_btn_text'),
            'cookie_preferences_btn_text' => __('cookie-consent.cookie_preferences_btn_text'),
            'cookie_preferences_save_text' => __('cookie-consent.cookie_preferences_save_text'),
        ];
    }

    /**
     * Gibt lokalisierte Cookie-Kategorien zurück
     *
     * @return array
     */
    public function getLocalizedCategories(): array
    {
        // Die Basiskonfiguration aus der Config-Datei abrufen
        $baseConfig = config('laravel-cookie-consent.cookie_categories');
        
        // Nur die lokalisierten Titel und Beschreibungen hinzufügen, ohne Sichtbarkeit zu ändern
        return [
            'necessary' => [
                'enabled' => $baseConfig['necessary']['enabled'] ?? true,
                'locked' => $baseConfig['necessary']['locked'] ?? true,
                'visible' => $baseConfig['necessary']['visible'] ?? true,
                'title' => __('cookie-consent.categories.necessary.title'),
                'description' => __('cookie-consent.categories.necessary.description'),
            ],
            'analytics' => [
                'enabled' => $baseConfig['analytics']['enabled'] ?? true,
                'locked' => $baseConfig['analytics']['locked'] ?? false,
                'visible' => $baseConfig['analytics']['visible'] ?? true,
                'js_action' => $baseConfig['analytics']['js_action'] ?? 'enableAnalytics',
                'title' => __('cookie-consent.categories.analytics.title'),
                'description' => __('cookie-consent.categories.analytics.description'),
            ],
            'marketing' => [
                'enabled' => $baseConfig['marketing']['enabled'] ?? false,
                'locked' => $baseConfig['marketing']['locked'] ?? false,
                'visible' => $baseConfig['marketing']['visible'] ?? true,
                'js_action' => $baseConfig['marketing']['js_action'] ?? 'enableMarketing',
                'title' => __('cookie-consent.categories.marketing.title'),
                'description' => __('cookie-consent.categories.marketing.description'),
            ],
            'preferences' => [
                'enabled' => $baseConfig['preferences']['enabled'] ?? true,
                'locked' => $baseConfig['preferences']['locked'] ?? false,
                'visible' => $baseConfig['preferences']['visible'] ?? true,
                'js_action' => $baseConfig['preferences']['js_action'] ?? 'saveUserLanguagePreference',
                'title' => __('cookie-consent.categories.preferences.title'),
                'description' => __('cookie-consent.categories.preferences.description'),
            ],
        ];
    }

    /**
     * Gibt lokalisierte Policy-Links zurück
     *
     * @return array
     */
    public function getLocalizedPolicyLinks(): array
    {
        return [
            'privacy_policy' => [
                'text' => __('cookie-consent.policy_links.privacy_policy'),
                'link' => route('privacy.policy', ['locale' => app()->getLocale()])
            ]
        ];
    }

    /**
     * Prüft ob eine bestimmte Cookie-Kategorie aktiviert ist
     *
     * @param string $category
     * @return bool
     */
    public function isCategoryEnabled(string $category): bool
    {
        $categories = $this->getLocalizedCategories();
        
        return $categories[$category]['enabled'] ?? false;
    }

    /**
     * Gibt alle verfügbaren Cookie-Kategorien zurück
     *
     * @return array
     */
    public function getAvailableCategories(): array
    {
        return array_keys($this->getLocalizedCategories());
    }
    
    /**
     * Speichert eine Marketing-Einwilligung in der Datenbank
     *
     * @param array<string, mixed> $data Daten für die Einwilligung (email, consent)
     * @return bool Ob die Speicherung erfolgreich war
     */
    public function saveMarketingConsent(array $data): bool
    {
        try {
            // Prüfen, ob die E-Mail vorhanden ist
            if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                Log::warning('Ungültige E-Mail-Adresse bei Marketing-Einwilligung', ['email' => $data['email'] ?? 'nicht angegeben']);
                return false;
            }
            
            $consentGiven = isset($data['consent']) && filter_var($data['consent'], FILTER_VALIDATE_BOOLEAN);
            
            // Prüfen, ob bereits eine Einwilligung für diese E-Mail existiert
            $existingConsent = MarketingConsent::where('email', $data['email'])->first();
            
            if ($existingConsent) {
                // Vorhandenen Eintrag aktualisieren
                $existingConsent->update([
                    'consent_given' => $consentGiven,
                    'ip_address' => Request::ip(),
                    'user_agent' => Request::userAgent(),
                    'locale' => App::getLocale(),
                ]);
            } else {
                // Neuen Eintrag erstellen
                MarketingConsent::create([
                    'email' => $data['email'],
                    'consent_given' => $consentGiven,
                    'ip_address' => Request::ip(),
                    'user_agent' => Request::userAgent(),
                    'locale' => App::getLocale(),
                ]);
            }
            
            return true;
        } catch (\Exception $e) {
            Log::error('Fehler beim Speichern der Marketing-Einwilligung', [
                'error' => $e->getMessage(),
                'email' => $data['email'] ?? 'nicht angegeben'
            ]);
            return false;
        }
    }
    
    /**
     * Prüft, ob analytische Cookies akzeptiert wurden
     *
     * @return bool
     */
    public function hasAnalyticsCookiesConsent(): bool
    {
        return Cookie::has('laravel_cookie_consent_analytics') && 
               Cookie::get('laravel_cookie_consent_analytics') === 'true';
    }
    
    /**
     * Prüft, ob Marketing-Cookies akzeptiert wurden
     *
     * @return bool
     */
    public function hasMarketingCookiesConsent(): bool
    {
        return Cookie::has('laravel_cookie_consent_marketing') && 
               Cookie::get('laravel_cookie_consent_marketing') === 'true';
    }
}
