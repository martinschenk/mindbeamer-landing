#!/bin/bash

# Pfade einstellen
TARGET="/home/mbeamer/httpdocs"
GIT_DIR="/home/mbeamer/git/mindbeamer.git"
TMP_GIT_CLONE="/home/mbeamer/tmp_git_clone"
COMPOSER="/home/mbeamer/composer"

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
    log_message "Installiere Composer-Abhängigkeiten..."
    $COMPOSER install --no-dev --optimize-autoloader
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
    php artisan cache:clear
    php artisan config:clear
    php artisan view:clear
    php artisan route:clear
    
    # Optimierungen für Produktionsumgebung
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

log_message "Deployment abgeschlossen!"

# Temporäres Verzeichnis aufräumen
rm -rf "$TMP_GIT_CLONE"

exit 0
