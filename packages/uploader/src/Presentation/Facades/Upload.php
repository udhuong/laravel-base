<?php

namespace Udhuong\Uploader\Presentation\Facades;

use Illuminate\Support\Facades\Facade;

class Upload extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'upload';
    }
}
