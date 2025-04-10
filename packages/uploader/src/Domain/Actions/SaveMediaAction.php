<?php

namespace Udhuong\Uploader\Domain\Actions;

use Udhuong\Uploader\Domain\Contracts\MediaRepository;
use Udhuong\Uploader\Domain\Entity\Media;

class SaveMediaAction
{
    public function __construct(
        private readonly MediaRepository $mediaRepository,
    ) {
    }

    /**
     * @param Media $media
     * @return Media
     */
    public function handle(Media $media): Media
    {
        $media->id = $this->mediaRepository->save($media);
        return $media;
    }
}
