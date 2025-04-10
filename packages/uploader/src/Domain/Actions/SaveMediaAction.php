<?php

namespace Udhuong\Uploader\Domain\Actions;

use Udhuong\Uploader\Domain\Contracts\MediaRepository;
use Udhuong\Uploader\Domain\Entity\Media;

class SaveMediaAction
{
    public function __construct(
        private readonly MediaRepository $mediaRepository,
    )
    {
    }

    public function handle(Media $media): Media
    {

        return $media;
    }
}
