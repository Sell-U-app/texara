# TEXARA - plain PHP site on Apache, for Railway.
# The site relies on .htaccess (rewrites, 404, the leads.csv block), so Apache
# is used as-is instead of a php-fpm + nginx split.
FROM php:8.3-apache

RUN a2enmod rewrite expires deflate headers

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

COPY . /var/www/html/

# send.php appends every lead here.
RUN mkdir -p /var/www/html/storage \
 && chown -R www-data:www-data /var/www/html/storage

COPY docker/entrypoint.sh /usr/local/bin/texara-entrypoint
RUN chmod +x /usr/local/bin/texara-entrypoint

EXPOSE 8080
ENTRYPOINT ["texara-entrypoint"]
CMD ["apache2-foreground"]
