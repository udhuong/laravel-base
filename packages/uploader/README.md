## **📺 Laravel Uploader**

🚀 Package phục vụ việc upload file ảnh, video và tài liệu. Hỗ trợ 1 số tính năng liên quan đến ảnh, giúp tăng tính tái sử dụng và giảm lặp code.

## **📌 Tính năng chính**

✅ Cung cấp các class tiện ích dùng chung trong Laravel  
✅ Hỗ trợ tự động đăng ký Service Provider  
✅ Dễ dàng tích hợp vào các dự án Laravel  
✅ Hỗ trợ upload file ảnh, video và tài liệu
✅ Hỗ trợ upload file từ URL

## **👥 Cài đặt**
Cài đặt package qua Composer:
```bash
composer require udhuong/uploader
```

Thêm vào .env
```shell
$ docker exec -u www-data -it laravel_base_app php artisan migrate
$ docker exec -u www-data -it laravel_base_app php artisan storage:link
$ docker exec -u www-data -it laravel_base_app php artisan upload:test --url=https://cdn11.dienmaycholon.vn/filewebdmclnew/public/userupload/files/Image%20FP_2024/hinh-anh-avatar-ca-tinh-nu-2.jpg
$ docker exec -u www-data -it laravel_base_app php artisan upload:test --url=https://file-examples.com/storage/fee47d30d267f6756977e34/2017/04/file_example_MP4_480_1_5MG.mp4
```
