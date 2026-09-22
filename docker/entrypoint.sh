#!/bin/sh
# Railway hands the listening port in $PORT; the base image hardcodes 80.
set -e

PORT="${PORT:-8080}"

sed -ri "s/^Listen [0-9]+$/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:[0-9]+>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Say out loud what went wrong instead of dying on a one-line Apache error.
if ! apache2ctl -t 2>&1; then
    echo "texara: apache config is broken after binding to port ${PORT}" >&2
    echo "=== RUN: apache2 -v ==="      >&2; apache2 -v            >&2 || true
    echo "=== RUN: compilados (-l) ===" >&2; apache2 -l            >&2 || true
    echo "=== RUN: mods-enabled ==="    >&2; ls -1 /etc/apache2/mods-enabled/ >&2 || true
    echo "=== RUN: LoadModule mpm ==="  >&2; grep -rn "LoadModule.*mpm" /etc/apache2/ >&2 || true
    echo "=== RUN: ports.conf ==="      >&2; cat /etc/apache2/ports.conf >&2 || true
    exit 1
fi
echo "texara: apache listening on ${PORT}"

exec "$@"
