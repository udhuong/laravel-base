FROM php:8.3-fpm-alpine

# Cài đặt các gói cần thiết
RUN apk add --no-cache \
    bash \
    git \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    zip \
    libxml2-dev \
    nginx \
    supervisor \
    curl \
    shadow

# Cài đặt các extension PHP cần thiết
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo pdo_mysql gd opcache

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Tạo thư mục làm việc
WORKDIR /var/www

# Sao chép composer.json và composer.lock trước
COPY composer.json ./
RUN if [ -f "composer.lock" ]; then cp composer.lock .; fi

# Cài đặt dependencies trước khi thêm source code
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copy toàn bộ source code vào container
COPY --chown=www-data:www-data . .

# Chạy lại composer để kích hoạt các scripts của Laravel
RUN composer dump-autoload && composer run-script post-autoload-dump

# Phân quyền thư mục storage và bootstrap/cache
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
RUN chown -R www-data:www-data /var/www /var/lib/nginx /var/log/nginx \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/lib/nginx

# Cấu hình
COPY ./docker/nginx/http.d/default.conf /etc/nginx/http.d/default.conf
COPY ./docker/supervisord.conf /etc/supervisord.conf
COPY ./docker/php.ini /usr/local/etc/php/conf.d/php.ini
COPY ./docker/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY ./docker/www.conf /usr/local/etc/php-fpm.d/www.conf

# Chạy container với quyền www-data
#USER www-data

# Mở cổng cho PHP-FPM và Nginx
EXPOSE 80 9000

# Lệnh khởi chạy PHP-FPM và Nginx với Supervisor
CMD ["supervisord", "-c", "/etc/supervisord.conf"]
