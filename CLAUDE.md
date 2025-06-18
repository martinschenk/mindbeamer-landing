# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

MindBeamer.io is a multilingual Laravel 11 landing page with GDPR-compliant cookie consent. It supports German, English, Spanish, and Simplified Chinese with automatic browser language detection and SEO optimization.

## Essential Commands

### Development
```bash
# Start development server
php artisan serve

# Watch and build assets
npm run dev

# Build for production
npm run build
```

### Testing
```bash
# Run all tests
php artisan test
# or
vendor/bin/phpunit

# Run specific test suites
php artisan test tests/Unit/LocaleServiceTest.php
php artisan test tests/Feature/LocalizationTest.php

# Run tests with coverage (requires Xdebug)
php artisan test --coverage
```

### Code Quality & Linting
```bash
# Laravel Pint (PSR-12 formatting)
vendor/bin/pint

# Clear all caches (use when debugging)
php artisan config:clear && php artisan cache:clear && php artisan view:clear && php artisan route:clear
```

### Performance Optimization
```bash
# Enable browser caching (already implemented via SetCacheHeaders middleware)
# Static assets: 1 year cache with immutable flag
# HTML pages: 5 minutes cache
# XML files: 5 minutes cache
```

### Production Optimization
```bash
# Cache for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Install production dependencies
composer install --no-dev --optimize-autoloader
npm run build
```

### Backup & SEO
```bash
# Generate sitemap
php artisan seo:generate-sitemap

# Run backup
php artisan backup:run

# List backups
php artisan backup:list
```

## Architecture Overview

### Core Framework
- **Laravel 11** with PHP 8.2+
- **SQLite** for development, supports MySQL/PostgreSQL for production
- **Vite** for asset building with Tailwind CSS and Alpine.js
- **Database sessions** for multilingual state management

### Key Services (Service Layer Pattern)

#### LocaleService (`app/Services/LocaleService.php`)
Central multilingual management system. All language functionality is driven by `config/languages.php`:
- Language detection and validation
- Display names and flag emojis
- Locale sanitization and normalization

#### TranslationService (`app/Services/TranslationService.php`)
Handles locale switching and translation state management.

#### CookieConsentService (`app/Services/CookieConsentService.php`)
GDPR-compliant cookie management with granular categories.

### Configuration-Driven Architecture
- **Central language config**: `config/languages.php` - Single source of truth for all multilingual features
- **No hardcoded values**: All settings configurable via config files
- **Services registered as singletons** in `AppServiceProvider`

### Multilingual Routing Structure
```
/ → Browser language detection → /{locale}/
/{locale}/ → Main landing page
/{locale}/privacy-policy
/{locale}/impressum
/{locale}/terms
/language/{locale} → Language switching endpoint
```

### Email System
- **Admin notifications**: `DemoRequest` Mailable
- **User confirmations**: `DemoRequestConfirmation` Mailable  
- **Automatic language detection** based on current locale
- **Multilingual templates** using Laravel's `__()` helper

## Development Guidelines

### Code Standards
- **PSR-12** coding standard (enforced by Laravel Pint)
- **Strict typing**: `declare(strict_types=1);` in all PHP files
- **Complete PHPDoc** with `@param`, `@return`, `@throws`
- **Laravel naming conventions** for controllers, models, services

### Testing Requirements
- **100% test coverage** for core services (LocaleService, TranslationService)
- **PHPUnit 10.5** with strict typing and proper annotations
- **Isolated tests** using RefreshDatabase trait
- **Configuration-based testing** using `Config::set()` for dynamic tests

### Service Layer Principles
- **Business logic in services**, not controllers
- **Controllers only handle HTTP requests/responses**
- **Models only for data structures**
- **Single responsibility principle**

## Key Files and Locations

### Configuration
- `config/languages.php` - Central multilingual configuration
- `config/backup.php` - Backup system settings
- `phpunit.xml` - Test configuration with SQLite in-memory DB

### Services
- `app/Services/LocaleService.php` - Core language management
- `app/Services/TranslationService.php` - Translation state management
- `app/Services/CookieConsentService.php` - GDPR cookie handling

### Language Files
- `lang/{locale}/` - Translation files for each supported language
- Supports: `en`, `de`, `es`, `zh_CN`

### Custom Artisan Commands
- `app/Console/Commands/GenerateSitemap.php` - SEO sitemap generation
- `app/Console/Commands/GitPushBackup.php` - Automated backup system

### Middleware
- `app/Http/Middleware/SetLocale.php` - Automatic locale detection and setting
- `app/Http/Middleware/SetCacheHeaders.php` - Smart browser caching for performance

## Testing Guidelines

The project has comprehensive test coverage with 19 tests covering 81 assertions:

### Unit Tests (`tests/Unit/`)
- `LocaleServiceTest.php` - 11 tests for core language functionality
- Tests service instantiation, locale validation, sanitization, configuration handling

### Feature Tests (`tests/Feature/`)
- `LocalizationTest.php` - 8 tests for integration scenarios
- `SetLocaleMiddlewareTest.php` - Middleware functionality
- `TranslationControllerTest.php` - HTTP endpoint testing

### Test Execution
```bash
# Specific test files
vendor/bin/phpunit tests/Unit/LocaleServiceTest.php tests/Feature/LocalizationTest.php

# Test categories
vendor/bin/phpunit tests/Unit/  # Unit tests only
vendor/bin/phpunit tests/Feature/  # Feature tests only
```

## Common Workflows

### Adding New Language
1. Add locale to `config/languages.php` `available_locales` array
2. Add display name to `locale_names` array
3. Add flag emoji to `locale_flags` array
4. Create translation files in `lang/{locale}/`
5. Update middleware regex pattern if needed
6. Run tests to ensure configuration consistency

### Debugging Locale Issues
- Use `/debug/locale` route to inspect current locale state
- Use `/debug/locale/{test_locale}` to test specific locales
- Use `/debug/chinese` for Chinese-specific debugging

### Email Testing
- Development: MailPit on localhost:8025
- Testing: Use Laravel's Mail fake system in tests
- Templates: `resources/views/emails/`

## Production Considerations

### Caching Strategy
Always cache in production for optimal performance:
```bash
php artisan config:cache    # Cache configuration
php artisan route:cache     # Cache routes  
php artisan view:cache      # Cache Blade templates
php artisan optimize        # Cache framework bootstrap
```

### Security
- CSRF protection enabled on all forms
- Rate limiting on API endpoints (6 requests/minute)
- GDPR-compliant cookie consent
- No sensitive data in version control
- Fonts hosted locally for GDPR compliance (no Google Fonts tracking)

### SEO Features
- Automatic sitemap generation with multilingual support and image tags
- Canonical URLs for each language
- Meta tags optimized per language
- JSON-LD structured data (Organization, WebSite, BreadcrumbList)
- Robots.txt properly served (no 302 redirects)
- hreflang tags with x-default fallback

### Performance Features
- Browser caching via `SetCacheHeaders` middleware
- Static assets cached for 1 year with immutable flag
- Locally hosted fonts (Poppins, Inter) for faster loading
- Works reliably on Nginx+Apache (Plesk) environments

## Directory Structure Highlights

```
app/
├── Services/           # Business logic layer
├── Mail/              # Email templates and logic
├── Console/Commands/  # Custom Artisan commands
└── Http/Middleware/   # Custom middleware (SetLocale)

config/
└── languages.php     # Central multilingual configuration

lang/                  # Translation files
├── de/               # German translations
├── en/               # English translations  
├── es/               # Spanish translations
└── zh_CN/            # Simplified Chinese translations

docs/                  # Comprehensive documentation
├── DEVELOPMENT.md     # Architecture and coding standards
├── TESTING.md         # Testing guidelines and coverage
└── LOCALIZATION.md    # Multilingual implementation guide
```