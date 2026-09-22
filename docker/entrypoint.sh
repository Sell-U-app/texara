#!/bin/sh
# Railway hands the listening port in $PORT; the base image hardcodes 80.
set -e

PORT="${PORT:-8080}"

sed -ri "s/^Listen [0-9]+$/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:[0-9]+>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

exec "$@"
