# Changelog

All notable changes to the MindBeamer Landing Page project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
- Doppeltes Alpine.js-Laden vermieden, um "multiple instances" Fehler zu beheben
- Testimonial-Profilbilder korrigiert für bessere Geschlechterdarstellung
- Horizontales Scrollen auf mobilen Geräten verhindert
- Header- und Footer-Layout verbessert
- Anpassung des responsiven Breakpoints von md zu lg für die Header-Navigation

### Entfernt
- Überflüssige console.log-Einträge aus JavaScript-Dateien
- Persönliche Namensreferenzen aus dem Hero-Untertitel in allen Sprachen

### Sicherheit
- Privacy-First-Messaging in allen Sprachen

## [v1.1.0] - 2025-04-21

### Hinzugefügt
- Mehrsprachigkeitsunterstützung (Deutsch, Englisch)
- Kontaktformular mit Validierung und Feedback
- Filament Admin-Panel für Content-Management
- Integration mit Laravel Mail für Benachrichtigungen
- Responsive Layout basierend auf Tailwind CSS
- Cookie-Consent-Modul mit vollständiger DSGVO-Konformität
- Animierte UI-Elemente für bessere Benutzererfahrung

### Verbessert
- SEO-Optimierungen für bessere Suchmaschinenplatzierung
- Ladezeiten durch Asset-Minimierung und -Kompression
- Barrierefreiheit (Accessibility) nach WCAG-Richtlinien

### Behoben
- Mobile Navigation für kleine Bildschirme
- Formular-Handling bei schwachen Internetverbindungen

## [v1.0.0] - 2025-03-15

### Hinzugefügt
- Initiale Version der MindBeamer Landing Page
- Statische Inhalte mit Fokus auf Produkt-Features
- Hero-Sektion mit Call-to-Action
- Feature-Übersicht mit Icons und Beschreibungen
- Testimonials-Sektion mit Kundenbewertungen
- Footer mit wichtigen Links und Kontaktinformationen
- Einfaches Kontaktformular
- Grundlegende SEO-Optimierungen
- Deployment-Pipeline für automatisierte Veröffentlichung
