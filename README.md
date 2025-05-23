# MindBeamer Landing Page

A multilingual Laravel 11 landing page for MindBeamer.io with GDPR-compliant cookie consent.

## Features

- 🌍 **Multilingual Support**: German, English, Spanish
- 🛡️ **GDPR Compliant**: Cookie consent with granular controls
- 🎨 **Modern Design**: Pink-purple-teal gradient theme
- 📱 **Responsive**: Mobile-first design
- ⚡ **Performance**: Optimized for speed and SEO

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

```bash
# Start development server
php artisan serve

# Watch for asset changes
npm run dev
```

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

Proprietary - Martin Schenk S.L.
