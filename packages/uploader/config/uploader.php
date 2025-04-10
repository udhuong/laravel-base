<?php
return [
    /**
     * Disk được cấu hình trong file storage của laravel
     */
    'disk' => env('UPLOADER_DISK', 'public'),

    'directory' => 'uploads',

    'rules' => 'required|file|max:51200|mimes:jpg,jpeg,png,gif,mp4,mov,avi,pdf,doc,docx,xls,xlsx',
];
