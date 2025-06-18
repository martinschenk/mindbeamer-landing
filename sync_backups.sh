#!/bin/bash

#OJO Vorbereitung: chmod +x sync_backups.sh

# Define the source and target folders
sourceFolder="/Users/martin/Laravel-Projekte/mindbeamer.io.landing/storage/app/MindBeamer/"
targetFolder="/Users/martin/Library/Mobile Documents/com~apple~CloudDocs/Laravel-Projekte-Backups/mindbeamer.io.landing/"

# Use rsync to synchronize the folders
# The flags mean:
# -r: recursive into directories
# -a: archive mode (keeps permissions, etc)
# --ignore-existing: don't overwrite files that already exist in the target directory
rsync -ra --ignore-existing "$sourceFolder" "$targetFolder"

# Print a message to indicate completion
echo "Synchronization complete."
