# 🛠️ Development Documentation - MindBeamer.io

## Project Overview

MindBeamer.io is a Laravel 11 landing page with multilingual support and GDPR-compliant cookie management.

## 🏗️ Architecture

### Framework & Versions
- **Laravel**: 11.x
- **PHP**: 8.2+
- **Database**: SQLite (Development), MySQL/PostgreSQL (Production)
- **Session**: Database-based
- **Cache**: File-based

### Key Services

#### LocaleService
Central management of all language functions based on `config/languages.php`.

```php
$localeService = app(\App\Services\LocaleService::class);
```

#### TranslationService
Translation and locale management for the website.

#### CookieConsentService
GDPR-compliant cookie management with granular categories.

### Email System
- **Admin Notifications**: `DemoRequest` Mailable
- **User Confirmations**: `DemoRequestConfirmation` Mailable
- **Automatic Language Detection**: Based on current locale
- **Multilingual Templates**: Using the `__()` helper

## 📁 Project Structure

```
app/
├── Http/Controllers/
│   ├── Api/DemoRequestController.php    # Contact form API
│   └── LocaleController.php             # Language switching
├── Mail/
│   ├── DemoRequest.php                  # Admin email
│   └── DemoRequestConfirmation.php      # User email
├── Services/
│   ├── LocaleService.php               # Language management
│   ├── TranslationService.php          # Translations
│   └── CookieConsentService.php        # Cookie consent
└── Providers/
    └── AppServiceProvider.php          # Service registration

config/
├── languages.php                       # 🎯 CENTRAL language configuration
├── laravel-cookie-consent.php          # Cookie settings
└── backup.php                          # Backup configuration

lang/                                   # Translation files
├── de/
├── en/
└── es/

resources/
├── views/
│   ├── components/                      # Blade components
│   └── emails/                         # Email templates

docs/                                   # 📚 This documentation
├── LOCALIZATION.md                     # Multilingualism
└── DEVELOPMENT.md                      # Development (this file)
```

## 🔧 Development Guidelines

### Code Standards
- **PSR-12** Coding Standard
- **Strict Typing**: `declare(strict_types=1);` in all files
- **PHPDoc**: Complete documentation with `@param`, `@return`, `@throws`
- **Laravel Conventions**: Controller, model, and service naming

### Service Registration
All services are registered as singletons in `AppServiceProvider`:

```php
$this->app->singleton(LocaleService::class, function ($app) {
    return new LocaleService();
});
```

### Configuration
- **Central Configuration**: No hardcoded values
- **Environment Variables**: For environment-dependent settings
- **Config-driven**: Services use `Config::get()`

## 🎯 Key Principles

### 1. Single Source of Truth
- Languages: `config/languages.php`
- Email addresses: `config/mail.php`
- App settings: `config/app.php`

### 2. Service-Layer Pattern
- Business logic in services
- Controllers only for request/response handling
- Models only for data structures

### 3. DRY (Don't Repeat Yourself)
- Helpers for recurring functions
- Central services instead of duplicated logic
- Blade components instead of duplicated views

## Helpful Tips

### Debugging
- **Laravel Telescope**: Requests, mails, logs in dev
- **Laravel Debugbar**: Performance, queries in dev
- **Logging**: `Log::info()`, `Log::error()` etc.

### Performance
- **Route Caching**: `php artisan route:cache` in production
- **Config Caching**: `php artisan config:cache` in production
- **View Caching**: `php artisan view:cache` in production

### Deployment
```bash
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

## Additional Resources

- [Laravel 11 Documentation](https://laravel.com/docs/11.x)
- [Localization](LOCALIZATION.md)
- [Testing](TESTING.md)

### E-Mail-Testing
- **Development**: MailPit auf localhost:8025
- **Testing**: Mailable-Tests mit Laravel

## Checklisten
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
