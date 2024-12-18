#!/bin/bash

# Change to the script's directory
cd "$(dirname "$0")"

# Specify the directory where SQL files are located
directory="../storage/backups"

# Remove all SQL files from the directory
rm -f "$directory"/*.sql
