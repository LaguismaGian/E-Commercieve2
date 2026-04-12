# 1. Use an official PHP + Apache server image
FROM php:8.2-apache

# 2. Install required system tools and Node.js (for Tailwind)
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpng-dev libonig-dev libxml2-dev libpq-dev nodejs npm

# 3. Install Laravel's required PHP extensions (including PostgreSQL)
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip

# 4. Tell Apache to allow Laravel's URL routing
RUN a2enmod rewrite

# 5. Set our working directory
WORKDIR /var/www/html

# 6. Copy all your files into the server
COPY . .

# 7. Tell Apache that the "public" folder is the actual website
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 8. Install Composer & Download your PHP packages
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --optimize-autoloader --no-dev

# 9. Build your Tailwind CSS
RUN npm install
RUN npm run build

# 10. Give the server permission to write to storage (for images/cache)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 11. Copy the startup script, make it executable, and run it
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

CMD ["start.sh"]