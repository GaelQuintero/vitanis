# Usar una imagen de PHP con Apache
FROM php:8.2-apache

# Instalar extensiones necesarias para Laravel y MySQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    curl \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

RUN addgroup --system www-data && adduser --system --ingroup www-data www-data
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache


# Establecer permisos
RUN chmod -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto 80
EXPOSE 80

# Comando para iniciar Apache
CMD ["apache2-foreground"]
