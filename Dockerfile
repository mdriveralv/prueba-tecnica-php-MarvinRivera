FROM php:8.2-apache

# Instalar extensiones
RUN apt-get update &&   \
    apt-get install -y  \
    libpq-dev           \
    zip unzip git &&    \
    docker-php-ext-install pdo pdo_mysql

# Copiar aplicación a directorio de trabajo
COPY . /var/www/html/

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Instalar Composer y dependencias
RUN curl -sS https://getcomposer.org/installer | php    \
    && php composer.phar install                        \
    && chown -R www-data:www-data /var/www/html         \
    && chmod -R 777 /var/www/html

# Exponer puerto 80
EXPOSE 80

CMD ["apache2-foreground"]