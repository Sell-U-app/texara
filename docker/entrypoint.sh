#!/bin/sh
# Railway hands the listening port in $PORT; the base image hardcodes 80.
set -e

PORT="${PORT:-8080}"

sed -ri "s/^Listen [0-9]+$/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:[0-9]+>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Belt and braces: the image is built with mpm_prefork only, but a second MPM
# left enabled is exactly what took this container down before, and Apache dies
# on it. Idempotent, so it costs nothing when the image is already correct.
for m in mpm_event mpm_worker; do
    rm -f "/etc/apache2/mods-enabled/${m}.load" "/etc/apache2/mods-enabled/${m}.conf"
done

if ! apache2ctl -t 2>&1; then
    echo "texara: apache config is broken after binding to port ${PORT}" >&2
    echo "--- mods-enabled ---" >&2; ls -1 /etc/apache2/mods-enabled/ >&2 || true
    echo "--- ports.conf ---"   >&2; cat /etc/apache2/ports.conf       >&2 || true
    exit 1
fi
echo "texara: apache listening on ${PORT}"

exec "$@"
