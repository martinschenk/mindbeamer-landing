<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\App;

/**
 * Service für mehrsprachige Cookie Consent Konfiguration
 * 
 * Dieser Service stellt lokalisierte Cookie Consent Konfigurationen
 * für alle unterstützten Sprachen bereit (DE, EN, ES).
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
        return [
            'necessary' => [
                'enabled' => true,
                'locked' => true,
                'visible' => true,
                'title' => __('cookie-consent.categories.necessary.title'),
                'description' => __('cookie-consent.categories.necessary.description'),
            ],
            'analytics' => [
                'enabled' => false, // Show but unchecked by default
                'locked' => false,
                'visible' => true,
                'js_action' => 'enableAnalytics',
                'title' => __('cookie-consent.categories.analytics.title'),
                'description' => __('cookie-consent.categories.analytics.description'),
            ],
            'marketing' => [
                'enabled' => false, // Show but unchecked by default
                'locked' => false,
                'visible' => true,
                'js_action' => 'enableMarketing',
                'title' => __('cookie-consent.categories.marketing.title'),
                'description' => __('cookie-consent.categories.marketing.description'),
            ],
            'preferences' => [
                'enabled' => true, // Enable by default
                'locked' => false,
                'visible' => true,
                'js_action' => 'enablePreferences',
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
                'link' => route('privacy.policy')
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
}
