#!/bin/bash
set -e

cd /var/www/html

composer install --no-interaction --prefer-dist --optimize-autoloader

chown -R www-data:www-data storage bootstrap/cache

exec docker-php-entrypoint apache2-foreground
