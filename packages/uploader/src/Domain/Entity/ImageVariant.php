<?php

namespace Udhuong\Uploader\Domain\Entity;

use Udhuong\Uploader\Domain\ValueObjects\ImageVariantType;

class ImageVariant
{
    public int $id;
    public int $mediaId;
    public ImageVariantType $type;
    public string $path;
    public string $mimeType;
    public string $extension;
    public int $size;
    public int $width;
    public int $height;
    public string $disk;
}
