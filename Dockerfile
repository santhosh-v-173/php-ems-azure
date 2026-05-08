# ─────────────────────────────────────────────────────────────
#  EMS – PHP 8.2 + Nginx + Supervisord
#  Single container: php-fpm talks to nginx via Unix socket
# ─────────────────────────────────────────────────────────────
FROM php:8.2-fpm

# ── System packages ───────────────────────────────────────────
RUN apt-get update && apt-get install -y \
        nginx \
        supervisor \
        libssl-dev \
        ca-certificates \
        curl \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ── Create socket directory with correct permissions ──────────
# This must exist before either service starts
RUN mkdir -p /run/php \
    && chown www-data:www-data /run/php

# ── PHP-FPM pool config (socket path must match nginx.conf) ──
COPY www.conf /usr/local/etc/php-fpm.d/www.conf

# ── Nginx config ──────────────────────────────────────────────
# Remove the default site, copy ours in
RUN rm -f /etc/nginx/sites-enabled/default \
    && rm -f /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/conf.d/ems.conf

# ── Supervisord config ────────────────────────────────────────
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# ── PHP settings ─────────────────────────────────────────────
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
COPY php.ini /usr/local/etc/php/conf.d/ems.ini

# ── Application source ────────────────────────────────────────
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# ── Expose HTTP ───────────────────────────────────────────────
EXPOSE 80

# ── Start both services via supervisord ──────────────────────
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
