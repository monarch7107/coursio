#!/bin/sh
set -e
: "${PORT:=8080}"
if [ -z "${APP_KEY:-}" ]; then
  APP_KEY="$(php artisan key:generate --show --no-ansi)"
  export APP_KEY
fi
php artisan config:cache
php artisan route:cache
php artisan view:cache
exec php artisan serve --host=0.0.0.0 --port="$PORT"
