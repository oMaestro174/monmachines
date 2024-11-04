FROM php:8.0-fpm

# Install necessary packages and PHP extensions
RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    nginx \
    && docker-php-ext-install mysqli pdo pdo_mysql

# Configure Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Copy project files
COPY backend /var/www/html

# Expose port 80
EXPOSE 80

# Start Nginx and PHP-FPM
CMD ["sh", "-c", "nginx && php-fpm"]
