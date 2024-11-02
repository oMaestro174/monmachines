FROM php:8.0-fpm

# Instalar extensões PHP necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Instalar Nginx
RUN apt-get update && apt-get install -y nginx

# Configurar Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Copiar arquivos do projeto
COPY backend /var/www/html

# Expor porta 80
EXPOSE 80

# Iniciar Nginx e PHP-FPM
CMD ["sh", "-c", "nginx && php-fpm"]