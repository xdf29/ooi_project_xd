# Stage 1 - Build Frontend (Vite)
FROM node:22 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build && \
    mv public/dist/.vite/manifest.json public/dist/manifest.json || true

# Stage 2 - Backend (Laravel + PHP + Composer)
FROM php:8.1-apache AS backend

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip \
    && a2enmod rewrite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy app files
COPY . .

# Copy built frontend from Stage 1
COPY --from=frontend /app/public/dist ./public/dist

# Copy dist to build directory (Laravel looks for build by default)
RUN cp -r public/dist public/build || true

# Remove hot file if it exists (forces production asset usage)
RUN rm -f public/hot || true

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set proper permissions for storage and cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public/dist || true && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/public/dist || true

# Configure Apache
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/public\n\
    <Directory /var/www/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Laravel setup
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan cache:clear

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]