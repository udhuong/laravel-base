<?php

namespace Udhuong\Uploader\Infrastructure\Factories;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Udhuong\Uploader\Domain\Entity\Media;
use Udhuong\Uploader\Infrastructure\File\FFMpegService;
use Udhuong\Uploader\Presentation\Helpers\MediaHelper;

class MediaFactory
{
    /**
     * @param string $path
     * @param string|null $disk
     * @return Media
     */
    public static function fromUploaded(string $path, string $disk = null): Media
    {
        $storage = Storage::disk($disk);
        $media = new Media();
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $media->type = MediaHelper::detectFileType($extension);
        $media->originalName = '';
        $media->name = pathinfo($path, PATHINFO_FILENAME) . '.' . $extension;
        $media->path = $path;
        $media->mimeType = $storage->mimeType($path);
        $media->extension = $extension;
        $media->size = filesize($storage->path($path));
        $media->disk = $disk;

        $media->url = $storage->url($path);
        $media->createdAt = now();

        if (str_starts_with($media->mimeType, 'image/')) {
            [$width, $height] = getimagesize($storage->path($path));
            $media->width = $width;
            $media->height = $height;
        }

        if (str_starts_with($media->mimeType, 'video/')) {
            [$width, $height] = FFMpegService::getSize($disk, $path);
            $media->width = $width;
            $media->height = $height;
        }

        if (str_starts_with($media->mimeType, 'video/') || str_starts_with($media->mimeType, 'audio/')) {
            $media->duration = FFMpegService::getDuration($storage->path($path));
        }

        return $media;
    }
}
