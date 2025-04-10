## **📺 Laravel Uploader**

🚀 Package giúp mở rộng tính năng Laravel Passport với các class và file dùng chung, giúp tăng tính tái sử dụng và giảm lặp code.

## **📌 Tính năng chính**

✅ Cung cấp các class tiện ích dùng chung trong Laravel  
✅ Hỗ trợ tự động đăng ký Service Provider  
✅ Dễ dàng tích hợp vào các dự án Laravel  
✅ Hỗ trợ người dùng lấy token  
✅ Hỗ trợ server to server authentication

## **👥 Cài đặt**
Cài đặt package qua Composer:
```bash
composer require udhuong/passport-auth
```

Thêm vào .env
```shell
$ docker exec -u www-data -it laravel_base_app php artisan storage:link
$ docker exec -u www-data -it laravel_base_app php artisan upload:test --url=https://cdn11.dienmaycholon.vn/filewebdmclnew/public/userupload/files/Image%20FP_2024/hinh-anh-avatar-ca-tinh-nu-2.jpg
$ docker exec -u www-data -it laravel_base_app php artisan upload:test --url=https://file-examples.com/storage/fee47d30d267f6756977e34/2017/04/file_example_MP4_480_1_5MG.mp4
```
