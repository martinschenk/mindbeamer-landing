<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\LocaleService;
use App\Services\TranslationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;

/**
 * Feature tests for localization functionality
 * 
 * @covers \App\Services\LocaleService
 * @covers \App\Services\TranslationService
 */
class LocalizationTest extends TestCase
{
    use RefreshDatabase;

    private LocaleService $localeService;
    private TranslationService $translationService;
    private array $originalConfig;

    /**
     * Set up the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
        
        // Store original configuration for restoration
        $this->originalConfig = [
            'available_locales' => config('languages.available_locales'),
            'locale_names' => config('languages.locale_names'),
            'locale_flags' => config('languages.locale_flags'),
            'default_locale' => config('languages.default_locale'),
            'fallback_locale' => config('languages.fallback_locale'),
        ];
        
        $this->localeService = new LocaleService();
        $this->translationService = new TranslationService();
    }

    /**
     * Restore original configuration after each test.
     */
    protected function tearDown(): void
    {
        // Restore original configuration
        Config::set('languages.available_locales', $this->originalConfig['available_locales']);
        Config::set('languages.locale_names', $this->originalConfig['locale_names']);
        Config::set('languages.locale_flags', $this->originalConfig['locale_flags']);
        Config::set('languages.default_locale', $this->originalConfig['default_locale']);
        Config::set('languages.fallback_locale', $this->originalConfig['fallback_locale']);
        
        parent::tearDown();
    }

    /**
     * Test that locale can be set programmatically.
     * 
     * @test
     */
    public function it_sets_locale_programmatically(): void
    {
        $configuredLocales = config('languages.available_locales');
        $firstLocale = $configuredLocales[0] ?? 'en';
        $secondLocale = $configuredLocales[1] ?? 'de';
        
        // Test setting first configured locale
        App::setLocale($firstLocale);
        $this->assertEquals($firstLocale, App::getLocale());
        
        // Test setting second configured locale  
        App::setLocale($secondLocale);
        $this->assertEquals($secondLocale, App::getLocale());
    }

    /**
     * Test that both services return consistent configuration data.
     * 
     * @test
     */
    public function it_maintains_configuration_consistency(): void
    {
        $configuredLocales = config('languages.available_locales');
        
        // Both services should return the same available locales
        $localeServiceLocales = $this->localeService->getAvailableLocales();
        $translationServiceLocales = array_keys($this->translationService->getAvailableLocales());
        
        $this->assertEquals($configuredLocales, $localeServiceLocales);
        $this->assertEquals($configuredLocales, $translationServiceLocales);
        
        // Test display names consistency for each configured locale
        foreach ($configuredLocales as $locale) {
            $localeServiceName = $this->localeService->getDisplayName($locale);
            $translationServiceName = $this->translationService->getLocaleName($locale);
            
            $this->assertEquals($localeServiceName, $translationServiceName);
            $this->assertNotEmpty($localeServiceName);
        }
    }

    /**
     * Test that TranslationService works correctly with configured locales.
     * 
     * @test
     */
    public function it_uses_translation_service_correctly(): void
    {
        $configuredNames = config('languages.locale_names');
        $configuredLocales = config('languages.available_locales');
        
        $translationService = new TranslationService();
        
        // Test that the service returns expected locale names
        $localeNames = $translationService->getAvailableLocales();
        
        $this->assertIsArray($localeNames);
        
        // Check all configured locales are present
        foreach ($configuredLocales as $locale) {
            $this->assertArrayHasKey($locale, $localeNames);
        }
        
        // Test individual locale name retrieval matches configuration
        foreach ($configuredLocales as $locale) {
            $expected = $configuredNames[$locale];
            $actual = $translationService->getLocaleName($locale);
            $this->assertEquals($expected, $actual);
        }
        
        // Test invalid locale returns 'Unknown'
        $this->assertEquals('Unknown', $translationService->getLocaleName('invalid'));
    }

    /**
     * Test that invalid locales are handled correctly.
     * 
     * @test
     */
    public function it_handles_invalid_locales_gracefully(): void
    {
        $localeService = new LocaleService();
        
        // Test that invalid locales return fallback values
        $this->assertFalse($localeService->isSupported('fr'));
        $this->assertFalse($localeService->isSupported('invalid'));
        
        $configuredFallback = config('languages.fallback_locale');
        $this->assertEquals($configuredFallback, $localeService->sanitizeLocale('invalid'));
        
        // Test that unknown locale names return 'Unknown'
        $this->assertEquals('Unknown', $localeService->getDisplayName('invalid'));
        
        // Test that unknown locale flags return default flag
        $this->assertEquals('🏳️', $localeService->getFlag('invalid'));
    }

    /**
     * Test that both services can set and get locales correctly.
     * 
     * @test
     */
    public function it_sets_and_gets_locales_correctly(): void
    {
        $configuredLocales = config('languages.available_locales');
        $firstLocale = $configuredLocales[0] ?? 'en';
        $secondLocale = $configuredLocales[1] ?? 'de';
        
        $translationService = new TranslationService();
        
        // Test setting locale via TranslationService
        $translationService->setAppLocale($firstLocale);
        $this->assertEquals($firstLocale, $translationService->getCurrentLocale());
        
        // Test setting locale to second configured locale
        $translationService->setAppLocale($secondLocale);
        $this->assertEquals($secondLocale, $translationService->getCurrentLocale());
        
        // Test that invalid locale doesn't change current locale
        $translationService->setAppLocale('invalid');
        $this->assertEquals($secondLocale, $translationService->getCurrentLocale());
    }

    /**
     * Test that tests use configuration, not hardcoded values.
     * 
     * @test
     */
    public function it_uses_configuration_not_hardcoded_values(): void
    {
        // Test with modified configuration to ensure no hardcoding
        $customLocales = ['fr', 'it'];
        $customNames = ['fr' => 'Français', 'it' => 'Italiano'];
        $customFlags = ['fr' => '🇫🇷', 'it' => '🇮🇹'];
        
        Config::set('languages.available_locales', $customLocales);
        Config::set('languages.locale_names', $customNames);
        Config::set('languages.locale_flags', $customFlags);
        Config::set('languages.default_locale', 'fr');
        Config::set('languages.fallback_locale', 'fr');
        
        // Services should adapt to new configuration
        $this->assertEquals($customLocales, $this->localeService->getAvailableLocales());
        $this->assertEquals('Français', $this->localeService->getDisplayName('fr'));
        $this->assertEquals('🇮🇹', $this->localeService->getFlag('it'));
        $this->assertEquals('fr', $this->localeService->getDefaultLocale());
        $this->assertTrue($this->localeService->isSupported('fr'));
        $this->assertFalse($this->localeService->isSupported('en')); // No longer supported
    }

    /**
     * Test locale validation and sanitization with current config.
     * 
     * @test
     */
    public function it_validates_and_sanitizes_locales(): void
    {
        $configuredLocales = config('languages.available_locales');
        $configuredFallback = config('languages.fallback_locale');
        
        // All configured locales should be valid
        foreach ($configuredLocales as $locale) {
            $this->assertTrue($this->localeService->isSupported($locale));
            $this->assertEquals($locale, $this->localeService->sanitizeLocale($locale));
        }
        
        // Non-configured locales should sanitize to fallback
        $invalidLocales = ['xx', 'invalid', 'fr', 'it', 'zh'];
        foreach ($invalidLocales as $invalidLocale) {
            $this->assertEquals($configuredFallback, $this->localeService->sanitizeLocale($invalidLocale));
        }
    }

    /**
     * Test that system works with minimal configuration.
     * 
     * @test
     */
    public function it_handles_minimal_configuration(): void
    {
        // Test with minimal single-locale configuration
        Config::set('languages.available_locales', ['en']);
        Config::set('languages.locale_names', ['en' => 'English']);
        Config::set('languages.locale_flags', ['en' => '🇬🇧']);
        Config::set('languages.default_locale', 'en');
        Config::set('languages.fallback_locale', 'en');
        
        $this->assertEquals(['en'], $this->localeService->getAvailableLocales());
        $this->assertEquals('English', $this->localeService->getDisplayName('en'));
        $this->assertEquals('🇬🇧', $this->localeService->getFlag('en'));
        $this->assertTrue($this->localeService->isSupported('en'));
        $this->assertFalse($this->localeService->isSupported('de'));
        
        // TranslationService should work with minimal config
        $availableLocales = $this->translationService->getAvailableLocales();
        $this->assertArrayHasKey('en', $availableLocales);
        $this->assertEquals('English', $availableLocales['en']);
        $this->assertEquals('English', $this->translationService->getLocaleName('en'));
    }
}
