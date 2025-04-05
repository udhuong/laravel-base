```shell
#Kiểm tra cấu hình nginx
$ docker exec -it laravel_base_app nginx -t

# Kiểm tra log lỗi
$ docker exec -it laravel_base_app cat /var/log/supervisord.log
$ docker exec -it laravel_base_app cat /var/log/nginx.out.log
$ docker exec -it laravel_base_app cat /var/log/nginx.err.log
$ docker exec -it laravel_base_app cat /var/log/php-fpm.out.log
$ docker exec -it laravel_base_app cat /var/log/php-fpm.err.log
```
