#!/bin/bash

# Ensure permissions are correct
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public/dist /var/www/public/build 2>/dev/null || true
chmod -R 775 /var/www/storage /var/www/bootstrap/cache 2>/dev/null || true
chmod -R 755 /var/www/public/dist /var/www/public/build 2>/dev/null || true

# Ensure manifest exists in both locations
if [ -f /var/www/public/dist/manifest.json ] && [ ! -f /var/www/public/build/manifest.json ]; then
    cp /var/www/public/dist/manifest.json /var/www/public/build/manifest.json
fi

# Remove hot file if it exists
rm -f /var/www/public/hot

# Run Laravel optimizations (only if .env exists and APP_KEY is set)
if [ -f /var/www/.env ] && grep -q "APP_KEY=base64:" /var/www/.env; then
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
fi

# Run migrations (optional - uncomment if you have a database)
# php artisan migrate --force

# Start Apache
exec apache2-foreground

