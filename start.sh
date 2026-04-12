#!/bin/bash

echo "Starting deployment script..."

# 1. Clear old cached configs so it forces Laravel to read Render's environment variables
php artisan config:clear
php artisan cache:clear

# 2. Run migrations and seeders
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link

# 3. THE PERMISSION FIX: 
# Give ownership of the files back to the Apache web server AFTER artisan runs
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

echo "Setup complete. Starting Apache server..."

# 4. Turn on the actual web server
apache2-foreground