#!/bin/bash

echo "Starting deployment script..."

# 1. Run migrations to build the database tables
php artisan migrate --force

# 2. Run seeders to populate initial data (admin, products)
php artisan db:seed --force

# 3. Create the storage link for your product images
php artisan storage:link

echo "Setup complete. Starting Apache server..."

# 4. Turn on the actual web server
apache2-foreground