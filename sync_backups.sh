#!/bin/bash

#OJO Vorbereitung: chmod +x sync_backups.sh

# ============================================================================
# MindBeamer.io Backup to iCloud Sync Script
# ============================================================================
# This script synchronizes Laravel backups from the local storage directory
# to iCloud Drive for offsite backup protection.
# 
# Usage: ./sync_backups.sh
# ============================================================================

# Define color codes for better output visibility
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Define the source and target folders
sourceFolder="/Users/martin/Laravel-Projekte/mindbeamer.io.landing/storage/app/MindBeamer/"
targetFolder="/Users/martin/Library/Mobile Documents/com~apple~CloudDocs/Laravel-Projekte-Backups/mindbeamer.io.landing/"

# Print header
echo -e "${BLUE}============================================${NC}"
echo -e "${BLUE}MindBeamer.io Backup to iCloud Sync${NC}"
echo -e "${BLUE}============================================${NC}"
echo -e "Start time: $(date)"
echo ""

# Check if source folder exists
if [ ! -d "$sourceFolder" ]; then
    echo -e "${RED}ERROR: Source folder does not exist!${NC}"
    echo -e "Looking for: $sourceFolder"
    exit 1
fi

# Check if target folder exists, create if not
if [ ! -d "$targetFolder" ]; then
    echo -e "${YELLOW}Target folder does not exist. Creating it...${NC}"
    mkdir -p "$targetFolder"
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}✓ Target folder created successfully${NC}"
    else
        echo -e "${RED}ERROR: Could not create target folder!${NC}"
        exit 1
    fi
fi

# Show current backup statistics
echo -e "${BLUE}Backup Statistics:${NC}"
echo -e "Source: $sourceFolder"
echo -e "Target: $targetFolder"
echo ""

# Count existing files
sourceCount=$(find "$sourceFolder" -type f | wc -l | tr -d ' ')
targetCountBefore=$(find "$targetFolder" -type f | wc -l | tr -d ' ')
echo -e "Files in source: ${GREEN}$sourceCount${NC}"
echo -e "Files in iCloud before sync: ${GREEN}$targetCountBefore${NC}"
echo ""

# Show what will be synced (dry run)
echo -e "${BLUE}Checking for new files to sync...${NC}"
newFiles=$(rsync -ran --ignore-existing "$sourceFolder" "$targetFolder" | grep -v "^$" | grep -v "/$" | wc -l | tr -d ' ')

if [ "$newFiles" -eq 0 ]; then
    echo -e "${YELLOW}No new files to sync. All backups are already in iCloud.${NC}"
else
    echo -e "${GREEN}Found $newFiles new file(s) to sync${NC}"
    echo ""
    
    # Show the files that will be synced
    echo -e "${BLUE}Files to be synced:${NC}"
    rsync -ran --ignore-existing "$sourceFolder" "$targetFolder" | grep -v "^$" | grep -v "/$" | head -20
    
    # If there are more than 20 files, indicate this
    if [ "$newFiles" -gt 20 ]; then
        echo -e "${YELLOW}... and $((newFiles - 20)) more files${NC}"
    fi
fi

echo ""
echo -e "${BLUE}Starting synchronization...${NC}"

# Use rsync to synchronize the folders
# The flags mean:
# -r: recursive into directories
# -a: archive mode (keeps permissions, timestamps, etc)
# -v: verbose output to show what's being copied
# --ignore-existing: don't overwrite files that already exist in the target directory
# --stats: show transfer statistics at the end
rsync -rav --ignore-existing --stats "$sourceFolder" "$targetFolder"

# Check if rsync was successful
if [ $? -eq 0 ]; then
    echo ""
    echo -e "${GREEN}✓ Synchronization completed successfully!${NC}"
    
    # Count files after sync
    targetCountAfter=$(find "$targetFolder" -type f | wc -l | tr -d ' ')
    filesSynced=$((targetCountAfter - targetCountBefore))
    
    echo ""
    echo -e "${BLUE}Final Statistics:${NC}"
    echo -e "Files synced: ${GREEN}$filesSynced${NC}"
    echo -e "Total files in iCloud: ${GREEN}$targetCountAfter${NC}"
    
    # Calculate total backup size
    totalSize=$(du -sh "$targetFolder" | cut -f1)
    echo -e "Total backup size in iCloud: ${GREEN}$totalSize${NC}"
    
    # Important note about iCloud sync behavior
    echo ""
    echo -e "${YELLOW}⚠️  IMPORTANT NOTE about iCloud:${NC}"
    echo -e "${YELLOW}Files have been copied to the iCloud folder, but may not appear${NC}"
    echo -e "${YELLOW}immediately in Finder or on other devices. iCloud needs time to:${NC}"
    echo -e "${YELLOW}  1. Upload files to Apple's servers (depends on file size & internet speed)${NC}"
    echo -e "${YELLOW}  2. Index and process the new files${NC}"
    echo -e "${YELLOW}  3. Sync to your other Apple devices${NC}"
    echo -e ""
    echo -e "${YELLOW}You can check iCloud sync status by:${NC}"
    echo -e "${YELLOW}  - Looking for the cloud icon next to files in Finder${NC}"
    echo -e "${YELLOW}  - Checking iCloud status in System Settings > Apple ID > iCloud${NC}"
    echo -e "${YELLOW}  - Files with ☁️ are still uploading, ✓ means fully synced${NC}"
else
    echo ""
    echo -e "${RED}ERROR: Synchronization failed!${NC}"
    echo -e "Please check the error messages above."
    exit 1
fi

echo ""
echo -e "End time: $(date)"
echo -e "${BLUE}============================================${NC}"
