FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip \
    libicu-dev \
    curl \
    && docker-php-ext-install intl zip pdo_mysql

# Install Node
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Install PHP deps
RUN composer install --optimize-autoloader --no-interaction

# Install & build frontend
RUN npm install
RUN npm run build

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=${PORT}
