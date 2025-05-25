<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

/**
 * Feature Test für die SetLocale Middleware
 * 
 * Stellt sicher, dass die Locale korrekt gesetzt wird
 * und alle Sprachen gleich behandelt werden
 */
class SetLocaleMiddlewareTest extends TestCase
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
     * Test that the middleware sets the locale from the URL
     * and that all languages, including Chinese, are treated equally
     *
     * @test
     */
    public function it_sets_locale_from_url_for_all_languages(): void
    {
        // Test all supported locales, including Chinese
        $locales = ['en', 'de', 'es', 'zh_CN'];
        
        foreach ($locales as $locale) {
            // Clear any existing state
            Session::flush();
            App::setLocale('en');
            
            // When a route with the locale in the URL is accessed
            $response = $this->get("/{$locale}");
            
            // Then the response should be successful
            $response->assertStatus(200);
            
            // And the app locale should be set to the URL locale
            $this->assertEquals($locale, App::getLocale());
            
            // And the session should contain the locale
            $this->assertEquals($locale, session('locale'));
        }
    }

    /**
     * Test that the middleware sets the locale from the session
     * and that all languages, including Chinese, are treated equally
     *
     * @test
     */
    public function it_sets_locale_from_session_for_all_languages(): void
    {
        // Test all supported locales, including Chinese
        $locales = ['en', 'de', 'es', 'zh_CN'];
        
        foreach ($locales as $locale) {
            // Given a session with a locale
            Session::flush();
            Session::put('locale', $locale);
            Session::save();
            
            // When a route without a locale in the URL is accessed
            $response = $this->get('/');
            
            // Dann sollte es eine Umleitung sein (302)
            $response->assertStatus(302);
            
            // Die Session sollte die Locale enthalten
            $this->assertEquals($locale, session('locale'));
        }
    }

    /**
     * Test that the middleware sets the locale from the cookie
     * and that all languages, including Chinese, are treated equally
     *
     * @test
     */
    public function it_sets_locale_from_cookie_for_all_languages(): void
    {
        // Test all supported locales, including Chinese
        $locales = ['en', 'de', 'es', 'zh_CN'];
        
        foreach ($locales as $locale) {
            // Clear any existing state
            Session::flush();
            App::setLocale('en');
            
            // When a route is accessed with a cookie
            $response = $this->withCookie('app_locale', $locale)
                ->get('/');
            
            // Dann sollte es eine Umleitung sein (302)
            $response->assertStatus(302);
            
            // Die Session sollte die Locale enthalten
            $this->assertEquals($locale, session('locale'));
            
            // Eine weitere Anfrage an die Locale-Route sollte funktionieren
            $followupResponse = $this->get("/{$locale}");
            $followupResponse->assertStatus(200);
        }
    }

    /**
     * Test that the locale is correctly set in the HTML lang attribute
     * with proper format conversion (underscore to hyphen)
     *
     * @test
     */
    public function it_sets_correct_html_lang_attribute_format(): void
    {
        // Test Chinese locale
        // When a route with Chinese locale in the URL is accessed
        $response = $this->get('/zh_CN');
        
        // Then the response should be successful
        $response->assertStatus(200);
        
        // And the app locale should be set to zh_CN (with underscore)
        $this->assertEquals('zh_CN', App::getLocale());
        
        // But the HTML lang attribute should use the hyphen format
        $response->assertSee('<html lang="zh-CN">', false);
    }
}
