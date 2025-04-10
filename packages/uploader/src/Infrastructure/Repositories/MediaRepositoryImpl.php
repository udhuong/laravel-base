<?php

namespace Udhuong\Uploader\Infrastructure\Repositories;

use Udhuong\Uploader\Domain\Contracts\MediaRepository;
use Udhuong\Uploader\Domain\Entity\ImageVariant;
use Udhuong\Uploader\Domain\Entity\Media;

class MediaRepositoryImpl implements MediaRepository
{
    /**
     * @param Media[] $medias
     * @return void
     */
    public function saveMany(array $medias): void
    {
        // TODO: Implement saveMany() method.
    }

    /**
     * @param ImageVariant[] $imageVariants
     * @return void
     */
    public function saveImageVariantMany(array $imageVariants): void
    {
        // TODO: Implement saveImageVariantMany() method.
    }
}
