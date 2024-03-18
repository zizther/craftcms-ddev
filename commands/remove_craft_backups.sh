#!/bin/bash

# Specify the directory where SQL files are located
directory="../storage/backups"

# Remove all SQL files from the directory
rm -f "$directory"/*.sql
