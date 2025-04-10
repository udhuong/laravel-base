<?php

namespace Udhuong\Uploader\Facades;

use Illuminate\Support\Facades\Facade;

class Upload extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'upload';
    }
}
