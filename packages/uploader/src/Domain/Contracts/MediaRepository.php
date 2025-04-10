<?php

namespace Udhuong\Uploader\Domain\Contracts;

use Udhuong\Uploader\Domain\Entity\Media;

interface MediaRepository
{
    public function save(Media $media): int;
    public function saveImageVariantMany(array $imageVariants): void;
}
