#!/bin/bash

# Run Laravel optimizations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (optional - uncomment if you have a database)
# php artisan migrate --force

# Start Apache
apache2-foreground

