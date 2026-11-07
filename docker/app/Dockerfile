# Ambiente de desenvolvimento da aplicação (mesmo PHP da produção na Hostinger).
FROM php:8.5.12-cli-trixie

COPY --from=mlocati/php-extension-installer:2.13.2 /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions bcmath exif gd intl opcache pdo_mysql zip pcntl \
    && apt-get update \
    && apt-get install -y --no-install-recommends git unzip mariadb-client \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/html

EXPOSE 8000

# Servidor embutido do PHP com o roteador do Laravel. Não usa `artisan serve` porque ele só repassa
# algumas variáveis de ambiente aos workers, e as do compose (DB_HOST=mariadb) se perderiam.
# O roteador usa o diretório atual como pasta pública.
CMD ["sh", "-c", "cd public && exec php -S 0.0.0.0:8000 ../vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php"]
