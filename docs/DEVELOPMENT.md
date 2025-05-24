# 🛠️ Entwicklungsdokumentation - MindBeamer.io

## Projekt-Übersicht

MindBeamer.io ist eine Laravel 11 Landing Page mit mehrsprachiger Unterstützung und GDPR-konformem Cookie-Management.

## 🏗️ Architektur

### Framework & Versionen
- **Laravel**: 11.x
- **PHP**: 8.2+
- **Database**: SQLite (Development), MySQL/PostgreSQL (Production)
- **Session**: Database-basiert
- **Cache**: File-basiert

### Wichtige Services

#### LocaleService
Zentrale Verwaltung aller Sprach-Funktionen basierend auf `config/languages.php`.

```php
$localeService = app(\App\Services\LocaleService::class);
```

#### TranslationService
Übersetzungs- und Locale-Management für die Website.

#### CookieConsentService
GDPR-konformes Cookie-Management mit granularen Kategorien.

### E-Mail-System
- **Admin-Benachrichtigungen**: `DemoRequest` Mailable
- **User-Bestätigungen**: `DemoRequestConfirmation` Mailable
- **Automatische Sprach-Erkennung**: Basiert auf aktueller Locale
- **Mehrsprachige Templates**: Mit `__()` Helper

## 📁 Projektstruktur

```
app/
├── Http/Controllers/
│   ├── Api/DemoRequestController.php    # Kontaktformular-API
│   └── LocaleController.php             # Sprach-Umschaltung
├── Mail/
│   ├── DemoRequest.php                  # Admin-E-Mail
│   └── DemoRequestConfirmation.php      # User-E-Mail
├── Services/
│   ├── LocaleService.php               # Sprach-Management
│   ├── TranslationService.php          # Übersetzungen
│   └── CookieConsentService.php        # Cookie-Consent
└── Providers/
    └── AppServiceProvider.php          # Service-Registrierung

config/
├── languages.php                       # 🎯 ZENTRALE Sprach-Konfiguration
├── laravel-cookie-consent.php          # Cookie-Einstellungen
└── backup.php                          # Backup-Konfiguration

resources/
├── views/
│   ├── components/                      # Blade-Komponenten
│   └── emails/                         # E-Mail-Templates
└── lang/                               # Übersetzungsdateien
    ├── de/
    ├── en/
    └── es/

docs/                                   # 📚 Diese Dokumentation
├── LOCALIZATION.md                     # Mehrsprachigkeit
└── DEVELOPMENT.md                      # Entwicklung (diese Datei)
```

## 🔧 Entwicklungs-Richtlinien

### Code-Standards
- **PSR-12** Coding Standard
- **Strict Typing**: `declare(strict_types=1);` in allen Dateien
- **PHPDoc**: Vollständige Dokumentation mit `@param`, `@return`, `@throws`
- **Laravel-Konventionen**: Controller-, Model-, Service-Naming

### Service-Registrierung
Alle Services werden als Singletons im `AppServiceProvider` registriert:

```php
$this->app->singleton(LocaleService::class, function ($app) {
    return new LocaleService();
});
```

### Konfiguration
- **Zentrale Konfiguration**: Keine hardcoded Werte
- **Environment Variables**: Für umgebungsabhängige Einstellungen
- **Config-driven**: Services nutzen `Config::get()`

## 🎯 Wichtige Prinzipien

### 1. Single Source of Truth
- Sprachen: `config/languages.php`
- E-Mail-Adressen: `config/mail.php`
- App-Einstellungen: `config/app.php`

### 2. Service-Layer Pattern
- Business Logic in Services
- Controller nur für HTTP-Handling
- Dependency Injection über Laravel Container

### 3. Mehrsprachigkeit
- Übersetzungen mit `__()` Helper
- Keine hardcoded Texte
- Zentrale Sprachverwaltung

### 4. SOLID Principles
- Single Responsibility: Eine Klasse, eine Aufgabe
- Dependency Inversion: Abhängigkeit von Interfaces
- Interface Segregation: Kleine, spezifische Interfaces

## 🚀 Deployment

### Development
```bash
php artisan serve
php artisan config:clear
```

### Production
- Config caching aktiviert
- Laravel Optimizations
- Backup-System mit Spatie Laravel Backup

## 🧪 Testing

### E-Mail-Testing
- **Development**: MailPit auf localhost:8025
- **Testing**: Mailable-Tests mit Laravel

### Cache Management
```bash
php artisan config:clear    # Konfiguration
php artisan route:clear     # Routen
php artisan view:clear      # Views
```

## 📋 Checklisten

### Neue Feature entwickeln
- [ ] Service-Layer verwenden
- [ ] Zentrale Konfiguration prüfen
- [ ] Mehrsprachigkeit berücksichtigen
- [ ] PHPDoc hinzufügen
- [ ] Laravel-Standards befolgen

### Code Review
- [ ] PSR-12 konform
- [ ] Keine hardcoded Werte
- [ ] Services über DI injiziert
- [ ] Übersetzungen verwendet
- [ ] Dokumentation vollständig

## 🔗 Externe Abhängigkeiten

- **spatie/laravel-backup**: Backup-System
- **devrabiul/laravel-cookie-consent**: GDPR Cookie-Consent
- Standard Laravel 11 Packages

## 📞 Support

Bei Fragen zur Architektur oder Entwicklung:
- Dokumentation in `/docs/` prüfen
- Laravel 11 Dokumentation konsultieren
- Service-Layer für Business Logic nutzen
