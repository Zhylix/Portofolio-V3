# ==========================================
# Stage 1: Build Frontend Assets (Vite + Tailwind v4)
# ==========================================
FROM node:22-alpine AS frontend-builder
WORKDIR /app

COPY package*.json ./
RUN npm ci --ignore-scripts

COPY resources ./resources
COPY app ./app
COPY public ./public
COPY vite.config.js ./

RUN npm run build

# ==========================================
# Stage 2: Composer Dependencies Builder
# ==========================================
FROM composer:2 AS composer-builder
WORKDIR /app

COPY composer.json composer.lock ./
COPY app/Support/intl_shim.php ./app/Support/intl_shim.php

RUN composer install \
    --no-dev \
    --no-interaction \
    --no-scripts \
    --no-autoloader \
    --prefer-dist

# ==========================================
# Stage 3: Production FrankenPHP Runner
# ==========================================
FROM dunglas/frankenphp:1-php8.4-alpine AS runner

# Install system dependencies
RUN apk add --no-cache \
    bash \
    curl \
    ca-certificates \
    sqlite

# Install required PHP extensions (MySQL, PostgreSQL, SQLite, intl, gd, zip, bcmath, pcntl, opcache, exif)
RUN install-php-extensions \
    pdo_mysql \
    pdo_pgsql \
    pdo_sqlite \
    intl \
    gd \
    zip \
    bcmath \
    pcntl \
    opcache \
    exif

# Copy Composer binary from builder
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configure PHP production settings
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY docker/php.ini "$PHP_INI_DIR/conf.d/99-custom.ini"

WORKDIR /app

# Copy Composer vendor packages from stage 2
COPY --from=composer-builder /app/vendor ./vendor

# Copy application source code
COPY . .

# Copy compiled frontend assets from stage 1
COPY --from=frontend-builder /app/public/build ./public/build

# Copy Caddyfile and Entrypoint script
COPY docker/Caddyfile /etc/caddy/Caddyfile
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Optimize classmap and autoloader for production
RUN composer dump-autoload --optimize --classmap-authoritative --no-dev

# Prepare directories and permissions
RUN mkdir -p /app/storage/framework/cache/data \
             /app/storage/framework/sessions \
             /app/storage/framework/views \
             /app/storage/logs \
             /app/storage/app/public \
             /app/bootstrap/cache \
             /app/database && \
    chown -R www-data:www-data /app/storage /app/bootstrap/cache /app/database && \
    chmod -R 775 /app/storage /app/bootstrap/cache /app/database

# Default port for Render.com Web Service
EXPOSE 10000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
