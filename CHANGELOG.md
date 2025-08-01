# Changelog

All notable changes to the MindBeamer Landing Page project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [v2.3.0] - 2025-08-01

### ✨ **Added**
- **Complete Internationalization**: Full translation coverage for all 7 languages
  - Spanish: Fixed 273 missing translation keys (from 319 to 592 keys)
  - Chinese (zh_CN): Added 414 missing keys for complete coverage
  - Portuguese (pt_BR): Added 414 missing keys
  - French: Added 414 missing keys
  - German: Already complete at 592 keys
  - English: Source of truth with 592 keys
- **Hindi Language Support (hi)**: Complete implementation
  - All 592 translation keys with cultural adaptations
  - Devanagari script (हिन्दी) display name
  - SEO-friendly URLs: `/gizla-niti`, `/vidhi-suchna`, `/sharten`
  - Added to language dropdown with Indian flag emoji 🇮🇳
  - Culturally adapted content with Indian examples and names
- **Maria Story Visual**: 4-panel illustration showing transformation
  - Added to MariaStorySection between struggle title and social list
  - WebP format for optimal performance
  - Illustrates Maria's journey from stressed to relaxed with MindBeamer
- **SEO Enhancements**: Improved multilingual SEO implementation
  - Added priorities to sitemap (Home: 1.0, Legal pages: 0.5)
  - Added change frequencies (monthly for most pages)
  - Proper hreflang mapping with locale code conversion
  - Improved x-default handling in sitemap generation

### 🔧 **Changed**
- **Translation System**: Moved from hardcoded text to translation keys
  - Fixed demo-request.blade.php to use translation keys
  - Added email subject translations for all languages
  - Ensured all UI elements use proper localization
- **Pricing Display**: Standardized to USD across all languages
  - Changed from localized currencies to USD for consistency
  - Dynamic currency symbol using `pricing_currency` key
  - Fixed hardcoded $ symbol in PricingSection.vue
- **Trust Messaging**: Removed all palimpalem.com references
  - Updated to emphasize German engineering expertise
  - Removed palimpalem logo and mentions across all languages
  - Focused on direct demo proposition
- **Robots.txt**: Optimized for better SEO
  - Removed palimpalem.com reference
  - Added explicit allow/disallow rules for better crawler guidance

### 🐛 **Fixed**
- **Mobile Translation Issues**: Fixed missing translations on iPhone
  - Added missing `pricing_currency` key in all language files
  - Fixed translation keys showing as text (pricing_starter_name, etc.)
  - Resolved cache issues affecting mobile devices
- **Logo Distortion**: Fixed Startups Españolas logo aspect ratio
  - Added `w-auto object-contain` classes to maintain proportions
  - Prevented image stretching on mobile devices
- **Missing Translations**: Completed all partial translation files
  - Spanish: Added Maria story keys and 273 other missing translations
  - All languages now have complete 592-key coverage
- **Hindi Page White Screen**: Fixed Vue router configuration
  - Added 'hi' to router locale pattern: `/:locale(en|de|es|zh_CN|pt_BR|fr|hi)`
  - Added Hindi routes for all legal pages
  - Updated locale store and hreflang tags for complete Hindi support

### 📚 **Documentation**
- Updated CLAUDE.md to reflect v2.3.0 as current version
- Added complete internationalization details to documentation
- Updated essential commands and development guidelines
- Enhanced multilingual routing documentation with Hindi routes

### 🌐 **Internationalization Details**
- **Total Languages**: 7 (en, de, es, zh_CN, pt_BR, fr, hi)
- **Translation Coverage**: 100% (592 keys per language)
- **Cultural Adaptations**: Names, examples, and context for each market
- **URL Localization**: SEO-friendly URLs in native languages

## [v2.2.1] - 2025-07-10

### ✨ **Added**
- **XSL Stylesheet for Sitemap**: Human-readable sitemap display in browsers
  - Professional table layout with MindBeamer branding
  - Shows URLs, last modified dates, priorities, and language versions
  - No impact on search engine indexing
- **Automated Backup System**: Complete backup automation
  - Pre-commit hook for automatic sitemap regeneration
  - Post-commit hook for backup creation and iCloud sync
  - Backups now created with EVERY commit (changed from every 10th)
- **Enhanced iCloud Sync Script**: Improved sync_backups.sh
  - Colored output for better visibility
  - Pre-sync and post-sync statistics
  - Dry run preview showing files to be synced
  - Important notes about iCloud upload delays

### 🔧 **Changed**
- **GitPushBackup Command**: Modified to create backups on every commit
- **Post-commit Hook**: Added automatic iCloud sync after backup:clean

### 📚 **Documentation**
- Updated CLAUDE.md with Git hooks documentation
- Added backup automation details to essential commands

## [v2.2.0] - 2025-07-10

### ✨ **Added**
- **RootController**: New controller for SEO-optimized root domain handling
  - Serves English content on mindbeamer.io without redirects
  - Implements "Smart Cookie" approach for returning visitors
  - Differentiates between first-time and returning visitors
- **Language Preference Banner**: Non-intrusive banner for language switching
  - Shows only for supported non-English browser languages
  - Sets permanent cookie for future automatic redirects
  - GDPR-compliant (technical necessity cookie)
- **SEO Documentation**: Comprehensive SEO strategy guide in `docs/SEO-MULTILINGUAL-STRATEGY.md`
  - Explains the root domain approach
  - Documents user flows and Google behavior
  - Provides maintenance guidelines

### 🔧 **Changed**
- **Root Domain Behavior**: mindbeamer.io now serves content instead of redirecting
  - First-time visitors see English content with optional language banner
  - Returning visitors with language preference get redirected
- **Sitemap Generation**: Improved x-default hreflang handling
  - Homepage x-default points to root domain (not /en)
  - Subpages x-default points to English version
  - Uses LocalizedUrlHelper for consistency
- **Header Spacing**: Dynamic adjustment for language banner
  - Smooth transitions when banner appears/disappears
  - Proper stacking of banner, header, and content

### 🐛 **Fixed**
- Removed orphaned JavaScript code fragments in app-head.blade.php
- Fixed header overlap issues when language banner is displayed
- Cleaned up legacy files (old PHP layouts, unused controllers)
- Removed references to non-existent sendmail.php

### 🗑️ **Removed**
- Legacy files: app.php layout, LandingPageController
- Test/debug routes now only available in development environment
- Duplicate robots.txt from root directory

### 📚 **Documentation**
- Updated CLAUDE.md with v2.2.0 features and SEO improvements
- Added comprehensive SEO strategy documentation
- Enhanced code comments in RootController and GenerateSitemap

## [v2.1.0] - 2025-07-10

### ✨ **Added**
- **LocalizedUrlHelper**: New helper class for centralized URL management
  - Generates language-specific URLs (e.g., `/de/datenschutz-richtlinie` instead of `/de/privacy-policy`)
  - Maintains current page when switching languages
  - Ensures consistency between sitemap.xml and actual site URLs
- **Localized Routes**: All legal pages now support translated URLs
  - German: `datenschutz-richtlinie`, `impressum`, `agb`
  - Spanish: `politica-privacidad`, `aviso-legal`, `terminos`
  - English/Chinese: `privacy-policy`, `legal-notice`, `terms`

### 🔧 **Changed**
- Updated footer and header components to use LocalizedUrlHelper
- Language switcher now maintains the current page when switching languages
- Chinese language option only available in footer (as requested)
- Added comprehensive code comments explaining the URL localization system

### 📚 **Documentation**
- Updated CLAUDE.md with new URL structure and LocalizedUrlHelper information
- Added instructions for adding new languages with localized URLs
- Enhanced multilingual routing documentation

### 🐛 **Fixed**
- URL inconsistency between sitemap.xml and actual site links
- Language switcher now correctly switches to localized URLs

## [v2.0.0] - 2025-06-18

### 🔄 **BREAKING CHANGES**
- **Git LFS Removed**: Completely removed Git LFS from project to simplify deployment and fix production server issues
- **Pre-push Hook Updated**: Modified to work without LFS dependencies

### ✨ **Added**
- **Custom Favicon System**: Professional SVG favicon with Poppins Bold M design
  - Gradient background matching site theme (pink-purple-teal)
  - True Poppins Bold font converted to SVG paths for consistent rendering
  - 2025 best practices with data URLs for maximum compatibility
- **Enhanced Typography**: Explicit Poppins font family for MindBeamer logo in header
- **Improved Git Workflow**: Streamlined deployment without LFS complexities

### 🔧 **Changed**
- **Font Management**: Moved all fonts from Git LFS to regular Git tracking
- **Favicon Implementation**: Switched from static files to inline SVG data URLs
- **Development Workflow**: Simplified local development without LFS requirements

### 🐛 **Fixed**
- **Production Deployment**: Resolved `git-lfs-authenticate` command not found errors
- **Font Loading**: Fixed fallback to system fonts issue in favicon
- **Favicon Orientation**: Corrected upside-down M display
- **Favicon Proportions**: Adjusted M width to match proper Poppins spacing

### 🗑️ **Removed**
- All Git LFS configurations and tracking
- Static favicon files (favicon.ico, favicon.svg, icon.svg)
- Unused FaviconController and related routes
- LFS dependencies from pre-push hook

### 🏗️ **Technical Improvements**
- Cleaner repository structure without LFS artifacts
- Faster cloning and deployment
- Better cross-platform compatibility
- Reduced server requirements (no LFS support needed)

## [v1.3.0] - 2025-06-18

### Added
- JSON-LD structured data for enhanced SEO (Organization, WebSite, BreadcrumbList schemas)
- Browser caching middleware (`SetCacheHeaders`) for optimal performance
- Local font hosting for GDPR compliance and better performance
- Image support in XML sitemap generation
- CLAUDE.md documentation file for Claude Code AI assistance
- Robots.txt route to fix 302 redirect issue

### Changed
- Sitemap generation now includes image namespace and SEO image tags
- Font loading switched from Google Fonts CDN to local hosting
- Cache headers now set via Laravel middleware instead of .htaccess

### Fixed
- Duplicate canonical tags removed from app-head.blade.php
- Robots.txt now returns 200 OK instead of 302 redirect
- Browser caching now works reliably on Nginx+Apache (Plesk) environments

### Performance
- Static assets cached for 1 year with immutable flag
- HTML pages cached for 5 minutes
- Reduced external font requests from 2 to 0
- Font files now served with optimal caching headers

## [v1.2.0] - 2025-05-25

### Hinzugefügt
- Chinesische Sprache (zh_CN) als vollständig unterstützte Sprache
- LocaleService für einheitliche Sprachverwaltung im Backend
- locale-helper.js für Client-seitige Spracherkennung und -verwaltung
- E-Mail-Bestätigungen für Benutzer bei Kontaktformular-Einreichungen
- Mehrsprachige Demo-Anfragen mit lokalisierten Admin-E-Mails
- Umfassende Tests für Mehrsprachigkeit

### Verbessert
- Vereinfachte Sprachumschaltung ohne Sonderfälle für Chinesisch
- Responsives Design für mobile Geräte optimiert
- Cookie-Consent-Modal neu implementiert mit besserer Zustandsverwaltung
- Modulare Blade-Templates für bessere Wiederverwendbarkeit
- Scroll-Funktionalität für Anker-Links
- How-it-works-Abschnitt mit Hover-Effekten und Gradient-Styling

### Behoben
- Session-basierte Weiterleitung für chinesische Sprache
- Cookie-Handling beim Sprachwechsel
- Responsive Design-Probleme
- Performance-Optimierungen bei Spracherkennung

### Geändert
- Sprachcode-Format von zh-CN zu zh_CN für bessere URL-Kompatibilität
- Verbesserte Error-Handling-Strategien
- Aktualisierte Tests für neue Sprachfunktionen

## [v1.1.0] - 2025-04-15

### Hinzugefügt
- Demo-Anfrageformular mit E-Mail-Benachrichtigungen
- Cookie-Consent-System mit anpassbaren Einstellungen
- Mehrsprachige Unterstützung (DE, EN, ES)
- Responsive Navigationsmenü
- Social Media Integration

### Verbessert
- Performance-Optimierungen
- SEO-Verbesserungen
- Mobile Benutzerfreundlichkeit

## [v1.0.0] - 2025-03-20

### Hinzugefügt
- Initiale Veröffentlichung der MindBeamer Landing Page
- Laravel 11 Framework
- Grundlegende mehrsprachige Unterstützung
- Modern UI mit Gradient-Designs
- GDPR-konforme Cookie-Verwaltung