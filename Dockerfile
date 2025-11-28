# Stage 1 - Build Frontend (Vite)
FROM node:22 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm ci --silent
COPY . .
RUN npm run build

# Stage 2 - Laravel Backend
FROM php:8.1-fpm AS backend

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libonig-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy Laravel code
COPY . .

# Safely copy built assets — never fails even if empty
RUN rm -rf public/dist && mkdir -p public/dist
COPY --from=frontend /app/public/dist/. public/dist/

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Laravel cache clearing
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

# Permissions (optional but recommended)
RUN chown -R www-data:www-data storage bootstrap/cache

CMD ["php-fpm"]