#!/bin/bash

echo "Starting deployment script..."

# 1. Clear old cached configs
php artisan config:clear
php artisan cache:clear

# 2. Run migrations and seeders
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link

# 3. THE PERMISSION FIX: 
# Give ownership of the storage and cache to the web server
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# NEW: Create the payments folder (if it doesn't exist) and give it write permissions!
mkdir -p /var/www/html/public/images/payments
chown -R www-data:www-data /var/www/html/public/images/payments

echo "Setup complete. Starting Apache server..."

# 4. Turn on the actual web server
apache2-foreground