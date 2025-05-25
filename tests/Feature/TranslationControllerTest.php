<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

/**
 * Feature Test für den TranslationController
 * 
 * Stellt sicher, dass die Sprachumschaltung korrekt funktioniert
 * und alle Sprachen gleich behandelt werden
 */
class TranslationControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test setup.
     */
    public function setUp(): void
    {
        parent::setUp();
        
        // Configure test languages
        Config::set('languages.available_locales', ['en', 'de', 'es', 'zh_CN']);
        Config::set('languages.default_locale', 'en');
        Config::set('languages.fallback_locale', 'en');
    }

    /**
     * Test that the language can be switched to any supported locale
     * and that all languages are treated equally (no special cases)
     *
     * @test
     */
    public function it_switches_language_correctly_for_all_locales(): void
    {
        // Test all supported locales, including Chinese
        $locales = ['en', 'de', 'es', 'zh_CN'];
        
        foreach ($locales as $locale) {
            // When the language is switched
            $response = $this->get(route('language.switch', ['locale' => $locale]));
            
            // Then the response should be a redirect
            $response->assertStatus(302);
            
            // And the session should contain the new locale
            $this->assertEquals($locale, session('locale'));
            
            // And the app locale should be set correctly
            $this->assertEquals($locale, app()->getLocale());
            
            // And the cookie should be set
            $response->assertCookie('app_locale', $locale);
        }
    }

    /**
     * Test that the referer is respected in redirects
     * 
     * @test
     */
    public function it_redirects_to_referer_after_language_switch(): void
    {
        // Given a referer
        $referer = route('home', ['locale' => 'en']);
        $targetLocale = 'zh_CN';
        
        // When the language is switched with a referer
        $response = $this->withHeaders([
            'referer' => $referer
        ])->get(route('language.switch', ['locale' => $targetLocale]));
        
        // Then the redirect should go to the referer
        $response->assertRedirect($referer);
        
        // And the session should contain the new locale
        $this->assertEquals($targetLocale, session('locale'));
    }

    /**
     * Test that when no referer is present, it redirects to the home route
     * 
     * @test
     */
    public function it_redirects_to_home_when_no_referer_is_present(): void
    {
        // For all locales, including Chinese
        $locales = ['en', 'de', 'es', 'zh_CN'];
        
        foreach ($locales as $locale) {
            // When the language is switched without a referer
            $response = $this->get(route('language.switch', ['locale' => $locale]));
            
            // Then the redirect should go to the home route with the new locale
            $response->assertRedirect(route('home', ['locale' => $locale]));
        }
    }

    /**
     * Test that all locales are treated equally without special cases
     * 
     * @test
     */
    public function it_treats_all_locales_equally_without_special_cases(): void
    {
        // Test all supported locales, including Chinese
        $locales = ['en', 'de', 'es', 'zh_CN'];
        
        foreach ($locales as $locale) {
            // Zurücksetzen des Session-Zustands
            Session::flush();
            
            // When the language is switched via GET (die tatsächliche Route ist GET)
            $response = $this->get(route('language.switch', ['locale' => $locale]));
            
            // Then the response should be a redirect
            $response->assertStatus(302);
            
            // Check for Chinese - it should be treated the same as other locales
            if ($locale === 'zh_CN') {
                // Chinese should have the same response headers as other locales
                // (No special Cache-Control headers)
                $response->assertHeader('Location');
                
                // And the session should be set correctly
                $this->assertEquals('zh_CN', session('locale'));
                
                // Es sollte keine Sonderbehandlung für Chinesisch mehr geben
                // Das Verhalten sollte identisch mit anderen Sprachen sein
                $this->assertFalse(session()->has('zh_special_handling'));
            }
        }
    }
}
