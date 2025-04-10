<?php

namespace Udhuong\Uploader\Domain\Entity;

use Carbon\Carbon;
use Udhuong\Uploader\Domain\ValueObjects\MediaType;

class Media
{
    public int $id;
    public int $userId;
    public MediaType $type;
    public string $originalName;
    public string $name;
    public string $path;
    public string $mimeType;
    public string $extension;
    public int $size = 0;
    public int $width = 0;
    public int $height = 0;
    public int $duration = 0;
    public string $disk;
    public ?Carbon $createdAt;

    public string $url;

    /**
     * @var ImageVariant[] $imageVariants
     */
    public array $imageVariants = [];
}
