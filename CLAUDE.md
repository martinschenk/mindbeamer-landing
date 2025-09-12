# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

MindBeamer.io is a multilingual Laravel 11 landing page with GDPR-compliant cookie consent. It supports German, English, Spanish, Simplified Chinese, Portuguese (Brazil), French, and Hindi with automatic browser language detection and SEO optimization.

**Current Version**: v2.3.0 (Minor Release - Complete Internationalization & Hindi Support)

### Key Features (v2.3.0)
- **Complete Translation Coverage**: Fixed all missing translation keys across all languages
- **Hindi Language Support**: Added full Hindi (hi) language with Devanagari script
- **Removed Palimpalem References**: All mentions of palimpalem.com removed from the site
- **USD Pricing Standardization**: All prices now displayed in USD across all languages
- **Maria Story Visual**: Added 4-panel illustration showing customer transformation
- **Mobile Optimizations**: Fixed logo distortion issues on iPhone displays
- **SEO Enhancements**: Improved multilingual SEO with proper hreflang implementation

### Previous Features (v2.2.1)
- **Human-Readable Sitemap**: Added XSL stylesheet for formatted sitemap display in browsers
- **Automatic Backup on Every Commit**: Changed from every 10th push to every single commit
- **iCloud Backup Sync**: Automatic synchronization of backups to iCloud after each commit
- **Enhanced sync_backups.sh**: Colored output, statistics, and progress reporting
- **Pre-commit Sitemap Generation**: Sitemap automatically regenerates before each commit

### Previous Features (v2.2.0)
- **SEO-Optimized Root Domain**: mindbeamer.io now serves content without redirects
- **Smart Cookie System**: Differentiates between first-time and returning visitors
- **Language Preference Banner**: Non-intrusive language switching for international users
- **Improved Sitemap**: x-default hreflang correctly points to root domain
- **RootController**: New controller for handling root domain requests with SEO strategy

### Previous Features (v2.1.0)
- **Localized URLs**: All pages use translated URLs (e.g., /de/datenschutz-richtlinie)
- **Smart Language Switching**: Maintains current page when switching languages
- **LocalizedUrlHelper**: Helper class for centralized URL management

### Previous Features (v2.0.0)
- **Git LFS Free**: Completely removed for simpler deployment
- **Professional Favicon**: Custom SVG favicon with Poppins Bold M design
- **Enhanced Typography**: Explicit Poppins font family throughout
- **Data URL Implementation**: Modern favicon approach with 2025 best practices
- **Streamlined Deployment**: No LFS dependencies, faster cloning

## Translation Management

### Translation Principles
- **English Language Files as Source of Truth**: English language files are the source of truth for all other languages and translations
- **Translation Workflow**: When changing or adding new texts:
  1. ALWAYS make changes in English first (`lang/en/`)
  2. English text definitions are mandatory and must be completed first
  3. After English texts are defined, translate them to ALL other supported languages
  4. Never modify texts in other languages without first updating the English version
  5. Maintain consistency across all language files - if a key exists in English, it must exist in all other languages

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
# Generate sitemap (also runs automatically on every commit)
php artisan seo:generate-sitemap

# Run backup manually (also runs automatically on every commit)
php artisan backup:run

# List backups
php artisan backup:list

# Sync backups to iCloud
./sync_backups.sh

# Track git pushes and create backup (used by post-commit hook)
php artisan backup:git-push
```

### Git Hooks (Automated Tasks)
The project includes automated Git hooks for consistency:

1. **Pre-commit Hook** (`/.git/hooks/pre-commit`):
   - Automatically regenerates sitemap.xml
   - Ensures sitemap is always current with latest changes

2. **Post-commit Hook** (`/.git/hooks/post-commit`):
   - Creates backup with every commit
   - Cleans old backups automatically
   - Syncs backups to iCloud for offsite storage

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

#### LocalizedUrlHelper (`app/Helpers/LocalizedUrlHelper.php`)
Manages localized URLs for all pages:
- Generates language-specific URLs (e.g., `/de/datenschutz-richtlinie` instead of `/de/privacy-policy`)
- Maintains current page when switching languages
- Ensures consistency between sitemap.xml and actual site URLs

### Configuration-Driven Architecture
- **Central language config**: `config/languages.php` - Single source of truth for all multilingual features
- **No hardcoded values**: All settings configurable via config files
- **Services registered as singletons** in `AppServiceProvider`

### Multilingual Routing Structure
```
/ → Serves English content (no redirect) + optional language banner
/{locale}/ → Main landing page in specific language

# Privacy Policy (localized URLs)
/en/privacy-policy
/de/datenschutz-richtlinie
/es/politica-privacidad
/zh_CN/privacy-policy

# Legal Notice/Impressum (localized URLs)
/en/legal-notice
/de/impressum
/es/aviso-legal
/zh_CN/legal-notice

# Terms (localized URLs)
/en/terms
/de/agb
/es/terminos
/zh_CN/terms

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

### Controllers
- `app/Http/Controllers/RootController.php` - SEO-optimized root domain handler
- `app/Http/Controllers/HomeController.php` - Language-specific home pages

### Services & Helpers
- `app/Services/LocaleService.php` - Core language management
- `app/Services/TranslationService.php` - Translation state management
- `app/Services/CookieConsentService.php` - GDPR cookie handling
- `app/Helpers/LocalizedUrlHelper.php` - Localized URL generation

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
5. Add URL translations to `app/Helpers/LocalizedUrlHelper.php`
6. Add corresponding routes in `routes/web.php`
7. Update sitemap generation in `app/Console/Commands/GenerateSitemap.php`
8. Run tests to ensure configuration consistency

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
- **Root domain serves content**: mindbeamer.io is now indexable (no redirects)
- **Smart Cookie approach**: First-time visitors see content, returning users get their language
- Automatic sitemap generation with multilingual support and image tags
- Canonical URLs for each language
- Meta tags optimized per language
- JSON-LD structured data (Organization, WebSite, BreadcrumbList)
- Robots.txt properly served
- hreflang tags with x-default pointing to root domain for homepage

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
├── LOCALIZATION.md    # Multilingual implementation guide
└── SEO-MULTILINGUAL-STRATEGY.md  # SEO strategy and root domain handling
```