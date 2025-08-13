FROM php:8.2-apache

# Instala a extensão mysqli
RUN docker-php-ext-install mysqli

# Habilita o módulo do Apache (opcional, se necessário)
RUN a2enmod rewrite
