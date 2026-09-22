# TEXARA - plain PHP site on Apache, for Railway.
# The site relies on .htaccess (rewrites, 404, the leads.csv block), so Apache
# is used as-is instead of a php-fpm + nginx split.
FROM php:8.3-apache

# php:8.3-apache ships mpm_event enabled, but mod_php only runs under
# mpm_prefork - and Apache refuses to start with two MPMs loaded at once.
# a2dismod will not drop the only MPM in place, so asking it to swap them just
# leaves both enabled; the symlinks are managed directly instead. Nothing here
# swallows stderr: a failure has to show up in the build log.
RUN rm -f /etc/apache2/mods-enabled/mpm_*.load /etc/apache2/mods-enabled/mpm_*.conf \
 && ln -s ../mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load \
 && ln -s ../mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf \
 && a2enmod rewrite expires deflate headers setenvif

# The container has no MTA, so PHP's mail() has nothing to hand the message to.
# msmtp-mta provides /usr/sbin/sendmail, which is exactly what mail() shells out
# to - so send.php keeps working unchanged and stays portable to cPanel.
RUN apt-get update \
 && apt-get install -y --no-install-recommends msmtp msmtp-mta ca-certificates \
 && rm -rf /var/lib/apt/lists/*

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Debian's apache2.conf ships AllowOverride None, which would silently ignore
# every rule in .htaccess.
RUN printf '%s\n' \
    'ServerName localhost' \
    'ServerTokens Prod' \
    'ServerSignature Off' \
    '<Directory /var/www/html>' \
    '    Options -Indexes +FollowSymLinks' \
    '    AllowOverride All' \
    '    Require all granted' \
    '</Directory>' \
    > /etc/apache2/conf-available/texara.conf \
 && a2enconf texara

# Fail the BUILD on a broken config instead of crash-looping at boot.
RUN echo "MPMs enabled:" && ls -1 /etc/apache2/mods-enabled/mpm_*.load \
 && test "$(ls -1 /etc/apache2/mods-enabled/mpm_*.load | wc -l)" = "1" \
 && apache2ctl -t \
 && apache2ctl -M | grep -E 'mpm_|rewrite_module' \
 && test -e /usr/sbin/sendmail

COPY . /var/www/html/

# send.php appends every lead here. On Railway this path is a mounted volume,
# so the entrypoint - not this layer - is what guarantees the permissions.
RUN mkdir -p /var/www/html/storage \
 && chown -R www-data:www-data /var/www/html/storage

COPY docker/entrypoint.sh /usr/local/bin/texara-entrypoint
RUN chmod +x /usr/local/bin/texara-entrypoint

EXPOSE 8080
ENTRYPOINT ["texara-entrypoint"]
CMD ["apache2-foreground"]
