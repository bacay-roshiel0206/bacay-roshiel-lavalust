```dockerfile
# ==============================
# Stage 1: Build frontend assets
# ==============================
FROM node:20-alpine AS node-builder

WORKDIR /app

# Copy package files
COPY package*.json ./

# Install dependencies even when package-lock.json is absent
RUN npm install --no-audit --no-fund

# Copy frontend source files
COPY . .

# Build Vite/Laravel frontend assets
RUN npm run build


# ==============================
# Stage 2: Production PHP image
# ==============================
FROM php:8.3-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        opcache \
    && rm -rf /var/cache/apk/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy Laravel application
COPY . .

# Copy compiled frontend assets
COPY --from=node-builder /app/public/build ./public/build

# Install PHP dependencies
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --prefer-dist

# Laravel permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Nginx configuration
RUN rm -f /etc/nginx/http.d/default.conf

COPY docker/nginx.conf /etc/nginx/http.d/default.conf

# Supervisor configuration
COPY docker/supervisord.conf /etc/supervisord.conf

# Render uses the PORT environment variable.
# Supervisor starts nginx and PHP-FPM.
EXPOSE 10000

CMD ["supervisord", "-c", "/etc/supervisord.conf"]
```
