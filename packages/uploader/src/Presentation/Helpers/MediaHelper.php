<?php


namespace Udhuong\Uploader\Presentation\Helpers;

use Udhuong\Uploader\Domain\ValueObjects\MediaType;

class MediaHelper
{
    /**
     * Lấy media type từ extension
     *
     * @param string $extension
     * @return MediaType
     */
    public static function detectFileType(string $extension): MediaType
    {
        $extension = strtolower($extension);

        $image = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp', 'tiff'];
        $video = ['mp4', 'avi', 'mov', 'mkv', 'webm', 'flv', 'mpeg'];
        $audio = ['mp3', 'wav', 'ogg', 'flac', 'aac', 'm4a'];
        $document = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'txt', 'csv'];
        $archive = ['zip', 'rar', '7z', 'tar', 'gz'];

        return match (true) {
            in_array($extension, $image) => MediaType::IMAGE,
            in_array($extension, $video) => MediaType::VIDEO,
            in_array($extension, $audio) => MediaType::AUDIO,
            in_array($extension, $document) => MediaType::DOCUMENT,
            in_array($extension, $archive) => MediaType::ARCHIVE,
            default => MediaType::UNKNOWN,
        };
    }

    /**
     * Format duration in seconds to HH:MM:SS
     *
     * @param int $duration
     * @return string
     */
    public static function formatDuration(int $duration): string
    {
        $hours = floor($duration / 3600);
        $minutes = floor(($duration % 3600) / 60);
        $seconds = $duration % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
