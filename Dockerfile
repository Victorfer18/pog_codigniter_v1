# Imagem base
FROM php:8.0-apache

# Habilitar módulos do Apache
RUN a2enmod rewrite

# Instalar extensões do PHP necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Configurar diretório de trabalho
WORKDIR /var/www/html

# Definir permissões para o diretório do projeto
RUN chown -R www-data:www-data /var/www/html

# Copiar arquivos do projeto para o contêiner
COPY . .

# Expor porta do Apache
EXPOSE 80
