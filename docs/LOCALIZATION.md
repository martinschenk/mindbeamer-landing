# 🌍 Mehrsprachigkeit (Localization) - MindBeamer.io

## Übersicht

MindBeamer.io unterstützt mehrere Sprachen durch ein zentrales Konfigurationssystem. Alle Sprach-Einstellungen werden in `config/languages.php` verwaltet.

## Aktuell unterstützte Sprachen

- **Deutsch** (de) 🇩🇪
- **Englisch** (en) 🇬🇧  
- **Spanisch** (es) 🇪🇸

## 🔧 Neue Sprache hinzufügen

### Schritt 1: Konfiguration erweitern

Erweitere `config/languages.php`:

```php
'available_locales' => [
    'en',
    'de', 
    'es',
    'it', // NEU: Italienisch hinzufügen
],

'locale_names' => [
    'en' => 'English',
    'de' => 'Deutsch',
    'es' => 'Español', 
    'it' => 'Italiano', // NEU
],

'locale_flags' => [
    'en' => '🇬🇧',
    'de' => '🇩🇪',
    'es' => '🇪🇸',
    'it' => '🇮🇹', // NEU
],
```

### Schritt 2: Übersetzungsdateien erstellen

Erstelle das Verzeichnis und die Übersetzungsdateien:

```bash
mkdir -p lang/it
```

Kopiere und übersetze folgende Dateien:
- `lang/it/messages.php` (Hauptübersetzungen)
- `lang/it/emails.php` (E-Mail-Übersetzungen)
- `lang/it/privacy.php` (Datenschutz-Texte)
- `lang/it/legal.php` (Rechtliche Texte)
- `lang/it/cookie-consent.php` (Cookie-Zustimmung)

### Schritt 3: Route hinzufügen

In `routes/web.php` füge hinzu:

```php
Route::get('/it', [LocaleController::class, 'it'])->name('locale.it');
```

### Schritt 4: Controller-Methode erstellen

In `app/Http/Controllers/LocaleController.php`:

```php
public function it()
{
    app()->setLocale('it');
    session()->put('locale', 'it');
    return redirect()->back();
}
```

### Schritt 5: Navigation erweitern

In der Sprachauswahl-Komponente (falls vorhanden) Italienisch hinzufügen.

## ✅ Das war's!

**Wichtig**: Das System erkennt die neue Sprache automatisch:
- ✅ E-Mails werden automatisch in der neuen Sprache gesendet
- ✅ Admin-E-Mails zeigen die korrekte Sprache-Information an
- ✅ Alle Services funktionieren ohne Code-Änderungen

## 🔍 System-Architektur

### Zentrale Konfiguration
- `config/languages.php` - Haupt-Konfigurationsdatei
- `app/Services/LocaleService.php` - Service für Sprach-Management
- `app/Services/TranslationService.php` - Übersetzungs-Service

### E-Mail-System
- `app/Mail/DemoRequest.php` - Admin-Benachrichtigung
- `app/Mail/DemoRequestConfirmation.php` - User-Bestätigung
- Templates automatisch mehrsprachig

### Wichtige Services
```php
$localeService = app(\App\Services\LocaleService::class);

// Verfügbare Sprachen abrufen
$locales = $localeService->getAvailableLocales();

// Anzeigename mit Flagge
$display = $localeService->getFormattedDisplayName('de'); // "Deutsch 🇩🇪"

// Sprache validieren
$valid = $localeService->sanitizeLocale('invalid'); // Fallback zu 'en'
```

## 🚫 Was NICHT getan werden sollte

- ❌ Hardcoded Sprach-Arrays in Templates oder Services
- ❌ Doppelte Konfiguration in `config/app.php` und `config/languages.php`
- ❌ Direkte Übersetzungen ohne `__()` Helper
- ❌ Sprach-spezifische if/else Blöcke im Code

## 🧪 Testing

Nach dem Hinzufügen einer neuen Sprache:

1. Cache leeren: `php artisan config:clear`
2. E-Mail-Funktionalität testen mit MailPit
3. Sprachauswahl auf der Website testen
4. Admin-E-Mails auf korrekte Sprach-Anzeige prüfen

## 📝 Troubleshooting

### Problem: Neue Sprache wird nicht erkannt
- ✅ Prüfe `config/languages.php` Syntax
- ✅ Führe `php artisan config:clear` aus
- ✅ Stelle sicher, dass alle Arrays erweitert wurden

### Problem: E-Mails in falscher Sprache
- ✅ Prüfe ob Übersetzungsdateien existieren
- ✅ Validiere `__()` Helper in Templates
- ✅ Teste `App::getLocale()` im Controller

### Problem: Flaggen werden nicht angezeigt
- ✅ Prüfe `locale_flags` Array in `config/languages.php`
- ✅ Stelle sicher, dass UTF-8 korrekt konfiguriert ist
