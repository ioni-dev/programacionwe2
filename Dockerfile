FROM php:8.0-apache

# Instalar dependencias y habilitar extensiones pdo_pgsql y pgsql
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Copiar los archivos del proyecto al contenedor
COPY . /var/www/html/

# Exponer el puerto 80
EXPOSE 80
