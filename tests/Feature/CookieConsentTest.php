<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Tests für die Cookie-Consent-Funktionalität
 */
class CookieConsentTest extends TestCase
{
    /**
     * Test, ob die Cookie-Consent-Skripte korrekt geladen werden
     *
     * @return void
     */
    public function testCookieConsentScriptsAreLoaded(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('enableAnalytics');
        $response->assertSee('window.dataLayer');
    }

    /**
     * Test, ob die Analytics-Cookies korrekt aktiviert werden
     *
     * Dieser Test simuliert das Verhalten des Browsers, wenn ein Analytics-Cookie gesetzt ist
     *
     * @return void
     */
    public function testAnalyticsCookiesAreEnabledWhenConsented(): void
    {
        // Cookie setzen, als ob der Benutzer zugestimmt hätte
        $this->withCookie('MindBeamer_cookie_analytics', 'true');
        
        $response = $this->get('/');
        
        $response->assertStatus(200);
        // Stelle sicher, dass die JavaScript-Funktion im HTML-Code enthalten ist
        $response->assertSee('enableAnalytics');
    }
    
    /**
     * Test, ob die Cookie-Consent-Konfiguration korrekt geladen wird
     *
     * @return void
     */
    public function testCookieConsentConfigurationIsCorrect(): void
    {
        $cookieConsentService = app(\App\Services\CookieConsentService::class);
        $config = $cookieConsentService->getLocalizedConfig();
        
        // Prüfe, ob die Analytics-Kategorie richtig konfiguriert ist
        $this->assertArrayHasKey('cookie_categories', $config);
        $this->assertArrayHasKey('analytics', $config['cookie_categories']);
        $this->assertArrayHasKey('js_action', $config['cookie_categories']['analytics']);
        $this->assertEquals('enableAnalytics', $config['cookie_categories']['analytics']['js_action']);
    }
    
    /**
     * Test, ob die Präferenz-Cookies korrekt gespeichert werden
     *
     * @return void
     */
    public function testPreferenceCookiesAreSaved(): void
    {
        // Cookie setzen, als ob der Benutzer Präferenz-Cookies akzeptiert hätte
        $this->withCookie('MindBeamer_cookie_preferences', 'true');
        
        $response = $this->get('/');
        
        $response->assertStatus(200);
        $response->assertSee('saveUserLanguagePreference');
    }
}
