<?php

namespace Udhuong\Uploader\Domain\Contracts;

interface MediaRepository
{
    public function saveMany(array $medias): void;
    public function saveImageVariantMany(array $imageVariants): void;
}
