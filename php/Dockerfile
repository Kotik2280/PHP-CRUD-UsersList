# Используем образ с Apache
FROM php:8.2-apache  

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

# Включаем mod_rewrite для красивых URL
# RUN a2enmod rewrite

# Копируем файлы приложения
COPY src/ .