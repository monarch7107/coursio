#!/bin/sh
set -eu

: "${PORT:=8080}"
export PORT

# Render can supply a stable APP_KEY; this fallback keeps first deployment simple.
if [ -z "${APP_KEY:-}" ]; then
  APP_KEY="$(php artisan key:generate --show --no-ansi)"
  export APP_KEY
fi

php artisan config:cache
php artisan route:cache
php artisan view:cache

exec php artisan serve --host=0.0.0.0 --port="$PORT"
