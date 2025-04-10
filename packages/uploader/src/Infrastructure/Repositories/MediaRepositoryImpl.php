<?php

namespace Udhuong\Uploader\Infrastructure\Repositories;

use Udhuong\Uploader\Domain\Contracts\MediaRepository;
use Udhuong\Uploader\Domain\Entity\ImageVariant;
use Udhuong\Uploader\Domain\Entity\Media;

class MediaRepositoryImpl implements MediaRepository
{
    /**
     * @param Media $media
     * @return int
     */
    public function save(Media $media): int
    {
        $insertData = [
            'user_id' => $media->userId,
            'type' => $media->type,
            'original_name' => $media->originalName,
            'name' => $media->name,
            'path' => $media->path,
            'mime_type' => $media->mimeType,
            'extension' => $media->extension,
            'size' => $media->size,
            'width' => $media->width,
            'height' => $media->height,
            'duration' => $media->duration,
            'disk' => $media->disk,
        ];
        return \DB::table('medias')->insertGetId($insertData);
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
