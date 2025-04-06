```shell
#Kiểm tra cấu hình nginx
$ docker exec -it laravel_base_app nginx -t

# Kiểm tra log lỗi
$ docker exec -it laravel_base_app cat /var/log/supervisord.log
$ docker exec -it laravel_base_app cat /var/log/nginx.out.log
$ docker exec -it laravel_base_app cat /var/log/nginx.err.log
$ docker exec -it laravel_base_app cat /var/log/php-fpm.out.log
$ docker exec -it laravel_base_app cat /var/log/php-fpm.err.log


$ docker exec -it laravel_base_app supervisorctl status
$ docker exec -it laravel_base_app supervisorctl reread # Đọc lại cấu hình mới
$ docker exec -it laravel_base_app supervisorctl update # Cập nhật lại cấu hình
$ docker exec -it laravel_base_app supervisorctl restart all # Restart tất cả các process
$ docker exec -it laravel_base_app supervisorctl restart laravel-queue # Restart process laravel-queue
```
composer require laravel/passport
```shell
# Tạo client mới
$ docker exec -it laravel_base_app php artisan passport:client

# Tạo client để sử dụng cho password grant
$ docker exec -it laravel_base_app php artisan passport:client --password

$  docker exec -u www-data -it laravel_base_app php artisan vendor:publish --tag=passport-auth-config
```

```shell

git submodule add https://github.com/udhuong/passport-auth packages/passport-auth
```
