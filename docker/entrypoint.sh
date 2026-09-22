#!/bin/sh
# Railway hands the listening port in $PORT; the base image hardcodes 80.
set -e

PORT="${PORT:-8080}"
STORAGE="/var/www/html/storage"

sed -ri "s/^Listen [0-9]+$/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:[0-9]+>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Belt and braces: the image is built with mpm_prefork only, but a second MPM
# left enabled is exactly what took this container down before, and Apache dies
# on it. Idempotent, so it costs nothing when the image is already correct.
for m in mpm_event mpm_worker; do
    rm -f "/etc/apache2/mods-enabled/${m}.load" "/etc/apache2/mods-enabled/${m}.conf"
done

# ---------------------------------------------------------------- storage ---
# A Railway volume mounts over this path, empty and owned by root, which hides
# whatever the image put here and leaves Apache unable to write. Both have to be
# fixed on every boot, not at build time.
mkdir -p "$STORAGE"
chown -R www-data:www-data "$STORAGE"
chmod 755 "$STORAGE"

# The volume also hides storage/.htaccess. The root .htaccess blocks *.csv on its
# own, but this is the deny that sits directly on the leads, so put it back.
if [ ! -f "$STORAGE/.htaccess" ]; then
    echo "Require all denied" > "$STORAGE/.htaccess"
    chown www-data:www-data "$STORAGE/.htaccess"
fi

# ------------------------------------------------------------------- mail ---
# mail() shells out to /usr/sbin/sendmail, which msmtp-mta provides. Credentials
# only exist as environment variables, so the config is written at boot - never
# baked into the image.
if [ -n "${SMTP_HOST:-}" ] && [ -n "${SMTP_USER:-}" ] && [ -n "${SMTP_PASS:-}" ]; then
    SMTP_PORT="${SMTP_PORT:-587}"
    MAIL_FROM="${MAIL_FROM:-no-reply@texara.co}"

    # Port 465 is implicit TLS; everything else negotiates with STARTTLS.
    if [ "$SMTP_PORT" = "465" ]; then
        STARTTLS="off"
    else
        STARTTLS="on"
    fi

    cat > /etc/msmtprc <<MSMTP
defaults
auth           on
tls            on
tls_starttls   ${STARTTLS}
tls_trust_file /etc/ssl/certs/ca-certificates.crt
logfile        /dev/stderr
timeout        20

account        default
host           ${SMTP_HOST}
port           ${SMTP_PORT}
from           ${MAIL_FROM}
user           ${SMTP_USER}
password       ${SMTP_PASS}
MSMTP

    # msmtp refuses a password file that others can read.
    chmod 600 /etc/msmtprc
    chown www-data:www-data /etc/msmtprc
    echo "texara: smtp configured -> ${SMTP_HOST}:${SMTP_PORT} as ${MAIL_FROM}"
else
    rm -f /etc/msmtprc
    echo "texara: WARNING - SMTP_HOST/SMTP_USER/SMTP_PASS not set." >&2
    echo "texara: WARNING - RFQ notifications will NOT be delivered." >&2
    echo "texara: WARNING - leads are still written to ${STORAGE}/leads.csv." >&2
fi

if ! apache2ctl -t 2>&1; then
    echo "texara: apache config is broken after binding to port ${PORT}" >&2
    echo "--- mods-enabled ---" >&2; ls -1 /etc/apache2/mods-enabled/ >&2 || true
    echo "--- ports.conf ---"   >&2; cat /etc/apache2/ports.conf       >&2 || true
    exit 1
fi
echo "texara: apache listening on ${PORT}"

exec "$@"
