<?php

namespace Udhuong\Uploader\Application\Services;

use FFMpeg\FFProbe;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Udhuong\Uploader\Domain\Entity\Media;
use Udhuong\Uploader\Domain\Entity\Uploaded;
use Udhuong\Uploader\Presentation\Helpers\MediaHelper;

class UploadService
{
    private string $directory;
    private string $disk;

    public function setDirectory(string $directory): self
    {
        $this->directory = $directory;
        return $this;
    }

    public function setDisk(string $disk): self
    {
        $this->disk = $disk;
        return $this;
    }

    /**
     * @param UploadedFile $file
     * @return Media
     */
    public function uploadFile(UploadedFile $file): Media
    {
        $this->validateFile($file);

        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = Storage::disk($this->disk)->putFileAs($this->directory, $file, $fileName);

        $media = new Media();
        $media->type = MediaHelper::detectFileType($file->getClientOriginalExtension());
        $media->originalName = $file->getClientOriginalName();
        $media->name = $fileName;
        $media->path = $path;
        $media->mimeType = $file->getMimeType();
        $media->extension = $file->getClientOriginalExtension();
        $media->size = $file->getSize();
        $media->disk = $this->disk;

        if (str_starts_with($file->getMimeType(), 'image/')) {
            [$width, $height] = getimagesize($file->getPathname());
            $media->width = $width;
            $media->height = $height;
        }

        if (str_starts_with($file->getMimeType(), 'video/')) {
            $ffprobe = FFProbe::create();
            $videoStream = $ffprobe
                ->streams(Storage::disk($this->disk)->path($path)) // path đến file video
                ->videos()       // chỉ lấy stream video
                ->first();       // lấy stream đầu tiên
            if ($videoStream) {
                $media->width = $videoStream->get('width');
                $media->height = $videoStream->get('height');
            }
        }

        if (str_starts_with($file->getMimeType(), 'video/') || str_starts_with($file->getMimeType(), 'audio/')) {
            $media->duration = FFProbe::create()
                ->format($file->getPathname())
                ->get('duration');
        }

        $media->url = Storage::disk($this->disk)->url($path);
        return $media;
    }

    /**
     * @param string $url
     * @param string|null $directory
     * @return Uploaded
     * @throws ConnectionException
     */
    public function uploadFromUrl(string $url, string $directory = null): Uploaded
    {
        $response = Http::get($url);
        if (!$response->successful()) {
            throw new ConnectionException('Unable to connect to the URL');
        }
        $path = $directory ?? config('uploader.directory');

        $clientOriginalName = explode('/', $url);
        $fileName = time() . '_' . array_pop($clientOriginalName);

        $pathStore = $path . '/' . $fileName;
        Storage::disk(config('uploader.disk'))->put($pathStore, $response->body());

        $uploaded = new Uploaded();
        $uploaded->path = $pathStore;
        $uploaded->url = Storage::disk(config('uploader.disk'))->url($pathStore);

        return $uploaded;
    }

    /**
     * @param string $url
     * @param string|null $directory
     * @return Uploaded
     * @throws ConnectionException
     */
    public function uploadSinkFromUrl(string $url, string $directory = null): Uploaded
    {
        $path = $directory ?? config('uploader.directory');

        $clientOriginalName = explode('/', $url);
        $fileName = time() . '_' . array_pop($clientOriginalName);

        $pathStore = $path . '/' . $fileName;

        $tempPath = storage_path("app/{$fileName}");
        Http::sink($tempPath)->get($url);
        Storage::move($tempPath, $pathStore);

        $uploaded = new Uploaded();
        $uploaded->path = $pathStore;
        $uploaded->url = Storage::disk(config('uploader.disk'))->url($pathStore);

        return $uploaded;
    }

    /**
     * @param UploadedFile $file
     * @return void
     */
    protected function validateFile(UploadedFile $file): void
    {
        $validator = Validator::make(
            ['file' => $file],
            ['file' => config('uploader.rules')]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
