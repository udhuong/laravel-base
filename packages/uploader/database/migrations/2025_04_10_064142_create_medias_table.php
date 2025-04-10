<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->default(0)->index()->comment('ID của người upload file');
            $table->tinyInteger('type')->index()->comment('Phân loại file: 1: image, 2: video, 3: audio, 4: document, 5: archive');
            $table->string('original_name')->comment('Tên gốc của file khi upload');
            $table->string('name')->comment('Tên sau upload');
            $table->string('path')->comment('Đường dẫn lưu file trên server (local, s3,...)');
            $table->string('mime_type')->default('')->comment('Kiểu file (image/jpeg, image/png, application/pdf,...)');
            $table->string('extension')->default('')->comment('Phần mở rộng của file (jpg, png, pdf, mp4,...)');
            $table->bigInteger('size')->default(0)->comment('Kích thước file (byte)');
            $table->integer('width')->default(0)->comment('Chiều rộng của ảnh (pixel)');
            $table->integer('height')->default(0)->comment('Chiều cao của ảnh (pixel)');
            $table->double('duration')->default(0)->comment('Thời gian video/audio (giây)');
            $table->string('disk', '50')->default('')->comment('Disk được cấu hình trong file config filesystems của laravel');
            $table->dateTime('created_at')->default(now());
        });

        Schema::create('media_image_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('media_id')->default(0)->index()->comment('ID của bảng medias');
            $table->tinyInteger('type')->default(0)->comment('Loại ảnh: 1: thumbnail, 2: medium, 3: large, 4: crop, 5: resize, 6: watermark');
            $table->string('path')->default('')->comment('Đường dẫn lưu file trên server (local, s3,...)');
            $table->string('mime_type')->default('')->comment('Kiểu file (image/jpeg, image/png, application/pdf,...)');
            $table->string('extension')->default('')->comment('Phần mở rộng của file (jpg, png, pdf, mp4,...)');
            $table->bigInteger('size')->default(0)->comment('Kích thước file (byte)');
            $table->integer('width')->default(0)->comment('Chiều rộng của ảnh (pixel)');
            $table->integer('height')->default(0)->comment('Chiều cao của ảnh (pixel)');
            $table->string('disk', '50')->default('')->comment('Disk được cấu hình trong file config filesystems của laravel');
            $table->dateTime('created_at')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias');
        Schema::dropIfExists('media_image_variants');
    }
};
