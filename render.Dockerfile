# Use Alpine PHP base image
FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache nginx supervisor bash curl \
    && apk add --no-cache $PHPIZE_DEPS \
    && docker-php-ext-install pdo pdo_mysql

# Copy project files into container
COPY ./websites /var/www/html

# Copy NGINX config
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Supervisor to manage both PHP and NGINX
COPY supervisord.conf /etc/supervisord.conf

# Set working directory
WORKDIR /var/www/html

# Expose HTTP port
EXPOSE 80

# Start supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
