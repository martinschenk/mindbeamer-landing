# MindBeamer Landing Page

A multilingual Laravel 11 landing page for MindBeamer.io with GDPR-compliant cookie consent.

## 🔍 Important Notice: Educational & Transparency Repository

This repository is made public for **educational and transparency purposes only**. The code is shared to demonstrate Laravel best practices, multilingual implementation, and modern web development techniques. While you may study, learn from, and suggest improvements to the code, please note the following restrictions:

- The MindBeamer name, brand, logos, and visual assets are **not** licensed for use
- You may not create derivative works using the MindBeamer name or brand
- See [LICENSE.md](LICENSE.md) for complete terms

We welcome contributions that improve code quality or documentation. See [CONTRIBUTING.md](CONTRIBUTING.md) for guidelines.

## Features

- 🌍 **Multilingual Support**: English, German, Spanish, Chinese, Portuguese, French, Hindi
- 🛡️ **GDPR Compliant**: Cookie consent with granular controls, locally hosted fonts
- 🎨 **Modern Design**: Pink-purple-teal gradient theme with custom Poppins favicon
- 📱 **Responsive**: Mobile-first design
- ⚡ **Performance**: Optimized for speed and SEO
- 🔍 **SEO Enhanced**: Multilingual sitemap with image support, structured data (JSON-LD)
- 🚀 **Browser Caching**: Smart cache headers for optimal performance
- 📊 **Structured Data**: Organization, WebSite, and BreadcrumbList schemas
- 🎯 **Custom Favicon**: SVG-based Poppins Bold M with gradient background
- 🔧 **Git LFS Free**: Streamlined development without LFS dependencies

## Tech Stack

- **Framework**: Laravel 11
- **PHP**: 8.2
- **Database**: SQLite
- **Frontend**: Tailwind CSS, Alpine.js
- **Package Management**: Composer, NPM

## Installation

1. Clone the repository
2. Copy environment file: `cp .env.example .env`
3. Install dependencies: `composer install && npm install`
4. Generate application key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Build assets: `npm run build`

## Development

### Local Development
```bash
php artisan serve
npm run dev
```

### Available Commands
```bash
php artisan config:clear    # Clear configuration cache
php artisan route:list      # List all routes
php artisan migrate:fresh   # Reset database
```

## 🧪 Tests

The project includes comprehensive test coverage for multilingual functionality and core features:

### Running Tests
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --filter=LocaleServiceTest

# Run with coverage report (requires Xdebug)
php artisan test --coverage
```

### Test Suites

- **Feature Tests**: Test HTTP requests, routes, and controller functionality
  - `TranslationControllerTest`: Tests language switching functionality
  - `SetLocaleMiddlewareTest`: Tests middleware for locale detection and setting
  - `ContactFormTest`: Tests contact form submission and validation

- **Unit Tests**: Test individual components and services
  - `LocaleServiceTest`: Tests locale normalization and validation
  - `CookieConsentServiceTest`: Tests cookie consent preferences
  - `EmailServiceTest`: Tests email template rendering and sending

All tests are designed to run in isolation without affecting your development database.

## 📚 Documentation

For detailed documentation, see the `/docs/` directory:

- **[📖 Development Guide](docs/DEVELOPMENT.md)** - Architecture, coding standards, and development workflow
- **[🧪 Testing Guide](docs/TESTING.md)** - PHPUnit testing standards and localization test suite
- **[🌍 Localization Guide](docs/LOCALIZATION.md)** - How to add new languages and manage translations
- **[🍪 Cookie Consent](docs/COOKIES.md)** - GDPR compliance and cookie management *(coming soon)*

### Quick Links
- **Add new language**: See [LOCALIZATION.md](docs/LOCALIZATION.md#-neue-sprache-hinzufügen)
- **Service architecture**: See [DEVELOPMENT.md](docs/DEVELOPMENT.md#️-architektur)
- **E-mail system**: See [DEVELOPMENT.md](docs/DEVELOPMENT.md#e-mail-system)

## Deployment

```bash
# Production optimization
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

## Environment Variables

Key environment variables for production:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://mindbeamer.io`
- `COOKIE_CONSENT_ENABLED=true`

## Features

### Cookie Consent System
- GDPR-compliant granular cookie control
- Multilingual support
- Custom MindBeamer branding

### Backup System  
- Automated daily database backups
- Weekly full backups
- Configurable retention policies

## License

MIT License with Additional Restrictions - See [LICENSE.md](LICENSE.md) for details.
