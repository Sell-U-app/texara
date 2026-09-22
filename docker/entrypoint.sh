#!/bin/sh
# Railway hands the listening port in $PORT; the base image hardcodes 80.
set -e

PORT="${PORT:-8080}"

sed -ri "s/^Listen [0-9]+$/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:[0-9]+>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Say out loud what went wrong instead of dying on a one-line Apache error.
apache2ctl -t || {
    echo "texara: apache config is broken after binding to port ${PORT}" >&2
    exit 1
}
echo "texara: apache listening on ${PORT}"

exec "$@"
