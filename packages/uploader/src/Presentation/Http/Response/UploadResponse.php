<?php

namespace Udhuong\Uploader\Presentation\Http\Response;

use Udhuong\Uploader\Domain\Entity\Media;

class UploadResponse
{
    /**
     * @param Media[] $medias
     * @return array
     */
    public static function format(array $medias): array
    {
        $responses = [];

        foreach ($medias as $media) {
            $responses[] = [
                'id' => $media->id,
                'type' => $media->type->value,
                'url' => $media->url,
                'path' => $media->path,
                'name' => $media->name,
                'size' => $media->size,
                'created_at' => $media->createdAt->format('Y-m-d H:i:s'),
            ];
        }

        return $responses;
    }
}
