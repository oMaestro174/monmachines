# Usar imagem base do PHP com FPM
FROM php:8.0-fpm

# Instalar Nginx e MariaDB
RUN apt-get update && \
    apt-get install -y nginx mariadb-server && \
    docker-php-ext-install mysqli pdo pdo_mysql

# Configurar Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Copiar o arquivo de inicialização do banco de dados para o diretório esperado pelo MariaDB
COPY data/machine_monitoring_2024-11-02.sql /docker-entrypoint-initdb.d/

# Copiar arquivos do projeto para o diretório web
COPY backend /var/www/html

# Expor a porta 80
EXPOSE 80

# Configurações para iniciar Nginx, MariaDB e PHP-FPM
CMD service mysql start && nginx && php-fpm
