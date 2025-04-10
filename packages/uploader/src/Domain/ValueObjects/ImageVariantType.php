<?php

namespace Udhuong\Uploader\Domain\ValueObjects;

enum ImageVariantType: int
{
    case THUMBNAIL = 1;
    case MEDIUM = 2;
    case LARGE = 3;
    case CROP = 4;
    case RESIZE = 5;
    case WATERMARK = 6;

    public function getLabel(): string
    {
        return match ($this) {
            self::THUMBNAIL => 'Thumbnail',
            self::MEDIUM => 'Medium',
            self::LARGE => 'Large',
            self::CROP => 'Crop',
            self::RESIZE => 'Resize',
            self::WATERMARK => 'Watermark',
        };
    }
}
