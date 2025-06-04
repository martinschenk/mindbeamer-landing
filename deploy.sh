#!/bin/bash

# Deployment-Skript für MindBeamer.io Landing Page
# Führt einen git pull durch und pusht auf GitHub und den Produktivserver
# Test für den aktualisierten Git-Hook mit Force-Push auf GitHub

# Farben für bessere Lesbarkeit
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${YELLOW}Starting deployment process for MindBeamer.io...${NC}"

# Aktuelle Branch ermitteln
CURRENT_BRANCH=$(git rev-parse --abbrev-ref HEAD)
echo -e "${GREEN}Current branch: ${CURRENT_BRANCH}${NC}"

# Sicherstellen, dass keine ungespeicherten Änderungen vorhanden sind
if ! git diff-index --quiet HEAD --; then
    echo -e "${RED}Es gibt ungespeicherte Änderungen. Bitte commit oder stash diese zuerst.${NC}"
    exit 1
fi

# Git Pull ausführen, um lokales Repository zu aktualisieren
echo -e "${YELLOW}Pulling latest changes from remote repository...${NC}"
git pull origin $CURRENT_BRANCH

if [ $? -ne 0 ]; then
    echo -e "${RED}Git pull fehlgeschlagen. Bitte löse Konflikte und versuche es erneut.${NC}"
    exit 1
fi

echo -e "${GREEN}Local repository updated successfully.${NC}"

# Auf GitHub pushen
echo -e "${YELLOW}Pushing to GitHub...${NC}"
git push github-mindbeamer-landing $CURRENT_BRANCH

if [ $? -ne 0 ]; then
    echo -e "${RED}Push to GitHub failed.${NC}"
    exit 1
fi

echo -e "${GREEN}Successfully pushed to GitHub.${NC}"

# Auf Produktivserver pushen
echo -e "${YELLOW}Pushing to production server...${NC}"
git push s22-mindbeamer-web $CURRENT_BRANCH

if [ $? -ne 0 ]; then
    echo -e "${RED}Push to production server failed.${NC}"
    exit 1
fi

echo -e "${GREEN}Successfully pushed to production server.${NC}"

# Deployment-Hooks werden automatisch auf dem Server ausgeführt:
# - composer install
# - npm run build
# - php artisan config:cache, etc.

echo -e "${GREEN}Deployment completed successfully!${NC}"
