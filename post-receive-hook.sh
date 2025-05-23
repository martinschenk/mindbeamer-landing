#!/bin/bash

# Enhanced error handling
set -e  # Exit immediately if a command exits with non-zero status
trap 'log_message "Error occurred. Deployment failed at line $LINENO"; exit 1' ERR

# Pfade einstellen
TARGET="/var/www/vhosts/mindbeamer.io/httpdocs"
GIT_DIR="/var/www/vhosts/mindbeamer.io/git/mindbeamer.git"
TMP_GIT_CLONE="/var/www/vhosts/mindbeamer.io/tmp_git_clone"
COMPOSER="/usr/local/bin/composer"
PHP="/opt/plesk/php/8.3/bin/php"

# Log-Funktion
log_message() {
    echo "[$(date '+%Y-%m-%d %H:%M:%S')] $1"
}

# Temporäres Verzeichnis löschen und neu erstellen
log_message "Bereinige temporäres Verzeichnis..."
rm -rf "$TMP_GIT_CLONE"
mkdir -p "$TMP_GIT_CLONE"

# Neueste Version in temporäres Verzeichnis auschecken
log_message "Checke neueste Version aus..."
git clone "$GIT_DIR" "$TMP_GIT_CLONE"

# Wechsel ins temporäre Verzeichnis
cd "$TMP_GIT_CLONE" || exit

# Composer-Abhängigkeiten installieren, wenn composer.json existiert
if [ -f "composer.json" ]; then
    log_message "Installiere Composer-Abhängigkeiten mit PHP 8.3..."
    # Use Plesk's composer with explicit PHP 8.3
    $PHP /usr/local/psa/var/modules/composer/composer.phar install --no-dev --optimize-autoloader
    
    # Verify vendor directory was created
    if [ ! -d "vendor" ]; then
        log_message "FEHLER: vendor-Verzeichnis wurde nicht erstellt"
        exit 1
    fi
fi

# Frontend-Assets bauen, wenn package.json existiert
if [ -f "package.json" ]; then
    log_message "Baue Frontend-Assets..."
    if command -v npm &>/dev/null; then
        npm ci --production
        npm run build
    else
        log_message "WARNUNG: npm nicht gefunden. Frontend-Assets werden nicht gebaut."
    fi
fi

# Spezielle Verzeichnisse erhalten (falls vorhanden)
log_message "Sichere spezielle Verzeichnisse und Dateien..."
if [ -d "$TARGET/storage" ]; then
    mkdir -p storage
    cp -rf "$TARGET/storage" .
fi

# .env-Datei erhalten, wenn sie existiert
if [ -f "$TARGET/.env" ]; then
    cp "$TARGET/.env" .
fi

# Dateien ins Zielverzeichnis kopieren
log_message "Kopiere Dateien ins Zielverzeichnis..."
rsync -a --delete --exclude='.env' --exclude='storage/logs/*' --exclude='storage/app/*' . "$TARGET/"

# Berechtigungen und Eigentümerschaft korrigieren
log_message "Korrigiere Berechtigungen..."
find "$TARGET" -type f -exec chmod 644 {} \;
find "$TARGET" -type d -exec chmod 755 {} \;

# Wenn es sich um ein Laravel-Projekt handelt, führe zusätzliche Aufgaben aus
if [ -f "$TARGET/artisan" ]; then
    log_message "Führe Laravel-spezifische Aufgaben aus..."
    chmod +x "$TARGET/artisan"
    
    # Cache löschen
    cd "$TARGET" || exit
    $PHP artisan cache:clear
    $PHP artisan config:clear
    $PHP artisan view:clear
    $PHP artisan route:clear
    
    # Datenbank-Migrationen ausführen (SQLite safe)
    if [ -f "database/database.sqlite" ] || [ ! -z "$DB_CONNECTION" ]; then
        log_message "Führe Datenbank-Migrationen aus..."
        $PHP artisan migrate --force
    fi
    
    # Optimierungen für Produktionsumgebung
    $PHP artisan config:cache
    $PHP artisan route:cache
    $PHP artisan view:cache
fi

log_message "Deployment abgeschlossen!"

# Temporäres Verzeichnis aufräumen
rm -rf "$TMP_GIT_CLONE"

exit 0
