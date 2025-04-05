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
