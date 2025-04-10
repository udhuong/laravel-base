# Laravel Base Project - Quản lý Docker, Passport, Horizon, Telescope

## Docker Commands

### Kiểm tra cấu hình Nginx
```shell
docker exec -it laravel_base_app nginx -t
```

### Kiểm tra logs
```shell
docker exec -it laravel_base_app cat /var/log/supervisord.log
docker exec -it laravel_base_app cat /var/log/nginx.out.log
docker exec -it laravel_base_app cat /var/log/nginx.err.log
docker exec -it laravel_base_app cat /var/log/php-fpm.out.log
docker exec -it laravel_base_app cat /var/log/php-fpm.err.log
```

### Supervisor
```shell
docker exec -it laravel_base_app supervisorctl status
docker exec -it laravel_base_app supervisorctl reread       # Đọc lại cấu hình mới
docker exec -it laravel_base_app supervisorctl update       # Cập nhật lại cấu hình
docker exec -it laravel_base_app supervisorctl restart all  # Restart tất cả các process
docker exec -it laravel_base_app supervisorctl restart laravel-queue # Restart process queue
```

## Laravel Passport

Cài đặt Passport:
```shell
composer require laravel/passport
docker exec -it laravel_base_app php artisan passport:client
docker exec -it laravel_base_app php artisan passport:client --password
docker exec -u www-data -it laravel_base_app php artisan vendor:publish --tag=passport-auth-config
```

Clone package custom Passport:
```shell
git submodule add https://github.com/udhuong/passport-auth packages/passport-auth
docker exec -u www-data -it laravel_base_app
```

## Laravel Horizon

Yêu cầu:
- PHP cài đặt ext-redis, pcntl, posix
- Composer package: predis/predis
- .env: REDIS_HOST=redis
- Thêm file cấu hình supervisor laravel-horizon.conf

## Laravel Telescope

Khuyến nghị:
- Sử dụng cho môi trường local hoặc thêm bảo mật khi dùng trên môi trường production.
- Thêm vào schedule:
php artisan schedule:run

- Cronjob server:
```shell
* * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
```

## Cronjob

Hiện tại, Supervisor đang chạy dưới quyền root để chạy được cronjob.

## Laravel Permission Commands

```shell
php artisan permission:create-role admin
php artisan permission:create-permission edit-articles
```

```shell
$ docker exec -u www-data -it laravel_base_app composer require --dev friendsofphp/php-cs-fixer
$ docker exec -u www-data -it laravel_base_app composer require --dev overtrue/phplint
# Format code cho chuẩn. Hoặc cài thủ công qua
$ docker exec -u www-data -it laravel_base_app vendor/bin/pint
$ docker exec -u www-data -it laravel_base_app vendor/bin/phplint
```
