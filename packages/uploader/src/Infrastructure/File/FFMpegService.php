<?php

namespace Udhuong\Uploader\Infrastructure\File;

use FFMpeg\FFProbe;
use Illuminate\Support\Facades\Storage;

class FFMpegService
{
    /**
     * Lấy thời gian video/audio
     *
     * @param string $path
     * @return int
     */
    public static function getDuration(string $path): int
    {
        return FFProbe::create()->format($path)->get('duration');
    }

    /**
     * Lấy kích thước video
     *
     * @param string $disk
     * @param string $path
     * @return int[]
     */
    public static function getSize(string $disk, string $path): array
    {
        $ffprobe = FFProbe::create();
        $videoStream = $ffprobe
            ->streams(Storage::disk($disk)->path($path)) // path đến file video
            ->videos()       // chỉ lấy stream video
            ->first();       // lấy stream đầu tiên
        $width = $height = 0;
        if ($videoStream) {
            $width = $videoStream->get('width');
            $height = $videoStream->get('height');
        }
        return [$width, $height];
    }
}
