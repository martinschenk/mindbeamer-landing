# Testing Guidelines

## Überblick

Diese Dokumentation beschreibt die Testingstruktur und -standards für die MindBeamer.io Laravel-Anwendung.

## Test-Framework

**PHPUnit 10.5.46** ist das Standard-Testing-Framework für Laravel 11 und wird für alle Tests verwendet.

## Testarten

### Unit Tests (`tests/Unit/`)

Unit Tests prüfen einzelne Klassen und Methoden isoliert.

#### LocaleServiceTest.php
- **Zweck**: Tests für die `LocaleService`-Klasse
- **Umfang**: 11 Tests, 35 Assertions
- **Getestete Funktionalität**:
  - Service-Instanziierung
  - Verfügbare Lokales aus Konfiguration
  - Display-Namen für Lokales
  - Flaggen für Lokales
  - Formatierte Display-Namen mit Flaggen
  - Standard- und Fallback-Lokales
  - Lokale-Validierung mit `isSupported()`
  - Lokale-Sanitization mit `sanitizeLocale()`
  - Behandlung leerer Konfiguration
  - Konfigurationskonsistenz

### Feature Tests (`tests/Feature/`)

Feature Tests prüfen die Integration verschiedener Komponenten.

#### LocalizationTest.php
- **Zweck**: Tests für das komplette Lokalisierungssystem
- **Umfang**: 8 Tests, 46 Assertions
- **Getestete Funktionalität**:
  - Programmatisches Setzen von Lokales
  - Konfigurationskonsistenz zwischen Services
  - TranslationService-Funktionalität
  - Behandlung ungültiger Lokales
  - Service-Interaktion (LocaleService + TranslationService)
  - Konfigurationsänderungen (keine hardcodierten Werte)
  - Lokale-Validierung und -Sanitization
  - Minimale Konfiguration

## Test-Ausführung

### Alle Lokalisierungstests
```bash
vendor/bin/phpunit tests/Unit/LocaleServiceTest.php tests/Feature/LocalizationTest.php
```

### Nur Unit Tests
```bash
vendor/bin/phpunit tests/Unit/LocaleServiceTest.php
```

### Nur Feature Tests
```bash
vendor/bin/phpunit tests/Feature/LocalizationTest.php
```

### Komplette Testsuite
```bash
vendor/bin/phpunit
```

## Coding Standards für Tests

### PHPUnit-Konventionen
- **Strict Typing**: `declare(strict_types=1);` in allen Test-Dateien
- **Methoden-Namen**: `it_does_something()` Format für bessere Lesbarkeit
- **Annotations**: `@test` Annotation für Test-Methoden
- **PHPDoc**: Vollständige Dokumentation mit `@covers` Tags

### Test-Struktur
```php
<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\SomeService;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Unit tests for SomeService
 * 
 * @covers \App\Services\SomeService
 */
class SomeServiceTest extends TestCase
{
    use RefreshDatabase;

    private SomeService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new SomeService();
    }

    /**
     * @test
     */
    public function it_does_something(): void
    {
        // Arrange
        $input = 'test';
        
        // Act
        $result = $this->service->doSomething($input);
        
        // Assert
        $this->assertEquals('expected', $result);
    }
}
```

## Konfigurationstests

### Test-Konfiguration
Tests verwenden `Config::set()` um Konfigurationswerte zu überschreiben:

```php
Config::set('languages.available_locales', ['en', 'de', 'es']);
Config::set('languages.locale_names', [
    'en' => 'English',
    'de' => 'Deutsch',
    'es' => 'Español'
]);
```

### Konfigurationskonsistenz
Tests stellen sicher, dass:
- Keine hardcodierten Werte verwendet werden
- Services auf Konfigurationsänderungen reagieren
- Alle Services konsistente Daten zurückgeben

## Testabdeckung

### LocaleService (100% Abdeckung)
- ✅ `getAvailableLocales()`
- ✅ `getDisplayName()`
- ✅ `getFlag()`
- ✅ `getFormattedDisplayName()`
- ✅ `getDefaultLocale()`
- ✅ `getFallbackLocale()`
- ✅ `isSupported()`
- ✅ `sanitizeLocale()`

### TranslationService (100% Abdeckung)
- ✅ `getCurrentLocale()`
- ✅ `setAppLocale()`
- ✅ `getAvailableLocales()`
- ✅ `getLocaleName()`
- ✅ `isCurrentLocale()`

## Debugging von Tests

### Häufige Probleme
1. **Undefined Methods**: Prüfen Sie, ob alle verwendeten Methoden in den Services existieren
2. **Konfigurationsfehler**: Stellen Sie sicher, dass `Config::set()` vor Service-Instanziierung aufgerufen wird
3. **Namespace-Probleme**: Vollqualifizierte Klassennamen in `use` Statements

### Test-Isolation
- Jeder Test ist isoliert und beeinflusst andere Tests nicht
- `RefreshDatabase` trait für Datenbank-Tests
- `setUp()` für Test-spezifische Konfiguration

## Best Practices

### Test-Benennung
- Beschreibende Namen: `it_returns_available_locales_from_config`
- Ein Test pro Funktionalität
- Positive und negative Testfälle

### Assertions
- Spezifische Assertions verwenden (`assertArrayHasKey` statt `assertTrue`)
- Erwartete Werte vor tatsächlichen Werten
- Klare Fehlermeldungen

### Mocking
- Vermeiden Sie Mocks wo möglich (gemäß Laravel-Regeln)
- Verwenden Sie echte Services für Integration
- `Mail::fake()` für E-Mail-Tests

## Integration mit CI/CD

Tests können automatisch in CI/CD-Pipelines ausgeführt werden:
```bash
php artisan config:clear
php artisan cache:clear
vendor/bin/phpunit
```

## Wartung

### Neue Tests hinzufügen
1. Erstellen Sie Test-Datei in entsprechendem Verzeichnis
2. Folgen Sie den Naming-Konventionen
3. Dokumentieren Sie Testabdeckung
4. Führen Sie alle Tests aus um Regression zu vermeiden

### Test-Updates
- Bei Service-Änderungen entsprechende Tests aktualisieren
- Neue Methoden müssen getestet werden
- Backward-Compatibility berücksichtigen

---

**Status**: Vollständige Testabdeckung für Lokalisierungssystem mit PHPUnit 10.5.46 ✅
