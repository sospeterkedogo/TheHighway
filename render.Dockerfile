FROM php:8.2-fpm-alpine

# Install system dependencies and PHP extensions in one go to reduce layers
RUN apk add --no-cache \
    nginx \
    supervisor \
    bash \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libxpm-dev \
    freetype-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd \
    && rm -rf /var/cache/apk/*

# Set working directory
WORKDIR /var/www/html

# Copy app files
COPY ./websites /var/www/html

# Copy NGINX and supervisor config
COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY supervisord.conf /etc/supervisord.conf

# Ensure correct permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port
EXPOSE 80

# Start both PHP and NGINX
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
