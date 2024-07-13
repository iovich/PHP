# Use the official PHP-FPM image as the base image
FROM php:8.2-fpm

# Set the working directory in the container
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip

# Встановлюємо розширення GD PHP
RUN apt-get update && apt-get install -y \
 		libfreetype-dev \
 		libjpeg62-turbo-dev \
 		libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libwebp-dev \
 	&& docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
 	&& docker-php-ext-install -j$(nproc) gd


# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy Laravel files to the container
COPY . .

# Install application dependencies
RUN composer install

RUN echo "file_uploads = On\n" \
         "memory_limit = 500M\n" \
         "upload_max_filesize = 500M\n" \
         "post_max_size = 500M\n" \
         "max_execution_time = 600\n" \
         > /usr/local/etc/php/conf.d/uploads.ini

## Run migrations
#RUN php artisan migrate --force

# Expose port 8000 to the host
EXPOSE 8000

# Start PHP-FPM server
CMD ["php","artisan","serve","--host=0.0.0.0"]
