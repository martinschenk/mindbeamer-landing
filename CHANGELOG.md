# Changelog

Alle wichtigen Änderungen am MindBeamer Landing Page Projekt werden in dieser Datei dokumentiert.

Das Format basiert auf [Keep a Changelog](https://keepachangelog.com/de/1.0.0/),
und dieses Projekt folgt der [Semantischen Versionierung](https://semver.org/lang/de/).

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
