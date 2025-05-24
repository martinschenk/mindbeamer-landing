<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\LocaleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;

/**
 * Unit tests for LocaleService
 * 
 * @covers \App\Services\LocaleService
 */
class LocaleServiceTest extends TestCase
{
    use RefreshDatabase;

    private LocaleService $localeService;
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
     * Test that LocaleService can be instantiated.
     * 
     * @test
     */
    public function it_can_be_instantiated(): void
    {
        $this->assertInstanceOf(LocaleService::class, $this->localeService);
    }

    /**
     * Test that available locales are retrieved from configuration.
     * 
     * @test
     */
    public function it_returns_available_locales_from_config(): void
    {
        $configuredLocales = config('languages.available_locales');
        $locales = $this->localeService->getAvailableLocales();
        
        $this->assertIsArray($locales);
        $this->assertEquals($configuredLocales, $locales);
        $this->assertContains('en', $locales); // We know 'en' should always be available
    }

    /**
     * Test that display names are retrieved correctly for each locale.
     * 
     * @test
     */
    public function it_returns_display_names_for_locales(): void
    {
        $configuredNames = config('languages.locale_names');
        $configuredLocales = config('languages.available_locales');
        
        foreach ($configuredLocales as $locale) {
            $displayName = $this->localeService->getDisplayName($locale);
            $this->assertEquals($configuredNames[$locale], $displayName);
            $this->assertNotEquals('Unknown', $displayName);
        }
        
        // Test invalid locale returns 'Unknown'
        $this->assertEquals('Unknown', $this->localeService->getDisplayName('invalid'));
    }

    /**
     * Test that flags are retrieved correctly for each locale.
     * 
     * @test
     */
    public function it_returns_flags_for_locales(): void
    {
        $configuredFlags = config('languages.locale_flags');
        $configuredLocales = config('languages.available_locales');
        
        foreach ($configuredLocales as $locale) {
            $flag = $this->localeService->getFlag($locale);
            $this->assertEquals($configuredFlags[$locale], $flag);
            $this->assertNotEquals('🏳️', $flag); // Should not be the default flag
        }
        
        // Test invalid locale returns default flag
        $this->assertEquals('🏳️', $this->localeService->getFlag('invalid'));
    }

    /**
     * Test that formatted display names include flags.
     * 
     * @test
     */
    public function it_returns_formatted_display_names_with_flags(): void
    {
        $configuredNames = config('languages.locale_names');
        $configuredFlags = config('languages.locale_flags');
        $configuredLocales = config('languages.available_locales');
        
        foreach ($configuredLocales as $locale) {
            $expected = sprintf('%s %s', $configuredNames[$locale], $configuredFlags[$locale]);
            $formatted = $this->localeService->getFormattedDisplayName($locale);
            $this->assertEquals($expected, $formatted);
        }
    }

    /**
     * Test that default locale is retrieved from configuration.
     * 
     * @test
     */
    public function it_returns_default_locale_from_config(): void
    {
        $configuredDefault = config('languages.default_locale');
        $defaultLocale = $this->localeService->getDefaultLocale();
        
        $this->assertEquals($configuredDefault, $defaultLocale);
    }

    /**
     * Test that fallback locale is retrieved from configuration.
     * 
     * @test
     */
    public function it_returns_fallback_locale_from_config(): void
    {
        $configuredFallback = config('languages.fallback_locale');
        $fallbackLocale = $this->localeService->getFallbackLocale();
        
        $this->assertEquals($configuredFallback, $fallbackLocale);
    }

    /**
     * Test that locale validation works correctly.
     * 
     * @test
     */
    public function it_validates_locales_correctly(): void
    {
        $configuredLocales = config('languages.available_locales');
        
        // Test that all configured locales are supported
        foreach ($configuredLocales as $locale) {
            $this->assertTrue($this->localeService->isSupported($locale));
        }
        
        // Test that non-configured locales are not supported
        $this->assertFalse($this->localeService->isSupported('fr'));
        $this->assertFalse($this->localeService->isSupported('invalid'));
    }

    /**
     * Test that locale sanitization works correctly.
     * 
     * @test
     */
    public function it_sanitizes_locales_correctly(): void
    {
        $configuredLocales = config('languages.available_locales');
        $configuredFallback = config('languages.fallback_locale');
        
        // Valid locales should be returned as-is
        foreach ($configuredLocales as $locale) {
            $this->assertEquals($locale, $this->localeService->sanitizeLocale($locale));
        }
        
        // Invalid locales should return fallback
        $this->assertEquals($configuredFallback, $this->localeService->sanitizeLocale('fr'));
        $this->assertEquals($configuredFallback, $this->localeService->sanitizeLocale('invalid'));
        $this->assertEquals($configuredFallback, $this->localeService->sanitizeLocale(''));
    }

    /**
     * Test that the service handles empty configuration gracefully.
     * 
     * @test
     */
    public function it_handles_empty_configuration_gracefully(): void
    {
        // Override config with empty values for this test
        Config::set('languages.available_locales', []);
        Config::set('languages.locale_names', []);
        Config::set('languages.locale_flags', []);
        
        $this->assertEquals([], $this->localeService->getAvailableLocales());
        $this->assertEquals('Unknown', $this->localeService->getDisplayName('en'));
        $this->assertEquals('🏳️', $this->localeService->getFlag('en'));
        $this->assertFalse($this->localeService->isSupported('en'));
    }

    /**
     * Test that configuration uses correct keys.
     * 
     * @test
     */
    public function it_uses_correct_configuration_keys(): void
    {
        // Test with a completely different configuration
        $testLocales = ['en', 'fr'];
        $testNames = ['en' => 'English', 'fr' => 'Français'];
        $testFlags = ['en' => '🇬🇧', 'fr' => '🇫🇷'];
        
        Config::set('languages.available_locales', $testLocales);
        Config::set('languages.locale_names', $testNames);
        Config::set('languages.locale_flags', $testFlags);
        Config::set('languages.default_locale', 'fr');
        Config::set('languages.fallback_locale', 'en');
        
        $this->assertEquals($testLocales, $this->localeService->getAvailableLocales());
        $this->assertEquals('English', $this->localeService->getDisplayName('en'));
        $this->assertEquals('🇫🇷', $this->localeService->getFlag('fr'));
        $this->assertEquals('fr', $this->localeService->getDefaultLocale());
        $this->assertEquals('en', $this->localeService->getFallbackLocale());
    }
}
