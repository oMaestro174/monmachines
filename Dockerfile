# Usar imagem base do PHP com FPM
FROM php:8.0-fpm

# Instalar Nginx e MySQL Server
RUN apt-get update && \
    apt-get install -y nginx mysql-server && \
    docker-php-ext-install mysqli pdo pdo_mysql

# Configurar Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Copiar o arquivo de inicialização do banco de dados para o diretório esperado pelo MySQL
COPY data/machine_monitoring_2024-11-02.sql /docker-entrypoint-initdb.d/

# Configurar MySQL e criar banco de dados e usuário
RUN service mysql start && \
    mysql -e "CREATE DATABASE machine_monitoring;" && \
    mysql -e "CREATE USER 'monitor'@'localhost' IDENTIFIED BY 'Mudar@123!';" && \
    mysql -e "GRANT ALL PRIVILEGES ON machine_monitoring.* TO 'monitor'@'localhost';" && \
    mysql -e "FLUSH PRIVILEGES;"

# Copiar arquivos do projeto para o diretório web
COPY backend /var/www/html

# Expor a porta 80
EXPOSE 80

# Configurações para iniciar Nginx, MySQL e PHP-FPM
CMD service mysql start && nginx && php-fpm
