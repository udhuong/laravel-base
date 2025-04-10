<?php

namespace Udhuong\Uploader\Domain\ValueObjects;

enum MediaType: int
{
    case UNKNOWN = 0;
    case IMAGE = 1;
    case VIDEO = 2;
    case AUDIO = 3;
    case DOCUMENT = 4;
    case ARCHIVE = 5;

    public function getLabel(): string
    {
        return match ($this) {
            self::UNKNOWN => 'Unknown',
            self::IMAGE => 'Image',
            self::VIDEO => 'Video',
            self::AUDIO => 'Audio',
            self::DOCUMENT => 'Document',
            self::ARCHIVE => 'Archive',
        };
    }
}
