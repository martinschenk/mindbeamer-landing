# Changelog

All notable changes to the MindBeamer Landing Page project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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