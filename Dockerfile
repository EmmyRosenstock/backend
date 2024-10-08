# Usar a imagem oficial do PHP com Apache
FROM php:8.1-apache

# Instalar dependências necessárias e extensões para PostgreSQL e Laravel
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    zip \
    && docker-php-ext-install pdo pdo_pgsql

# Instalar o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Expor a porta 80
EXPOSE 80
