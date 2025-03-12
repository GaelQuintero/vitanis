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

# Crear los directorios necesarios si no existen
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Crear el usuario www-data si no existe
RUN id www-data || adduser --disabled-password --gecos '' www-data

# Establecer permisos y propietario
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto 10000 (Render usa este puerto por defecto)
EXPOSE 10000

# Configurar Apache para escuchar en el puerto 10000
RUN echo "Listen 10000" > /etc/apache2/ports.conf
RUN sed -i 's/80/10000/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/default-ssl.conf

# Comando para iniciar Apache
CMD ["apache2-foreground"]