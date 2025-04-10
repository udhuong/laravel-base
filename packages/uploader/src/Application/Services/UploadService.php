<?php

namespace Udhuong\Uploader\Application\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Udhuong\Uploader\Domain\Entity\Uploaded;

class UploadService
{
    /**
     * @param UploadedFile $file
     * @param string|null $directory
     * @return Uploaded
     */
    public function uploadFile(UploadedFile $file, string $directory = null): Uploaded
    {
        $this->validateFile($file);
        $path = $directory ?? config('uploader.directory');

        $fileName = time() . '_' . $file->getClientOriginalName();

        $stored = Storage::disk(config('uploader.disk'))->putFileAs($path, $file, $fileName);

        $uploaded = new Uploaded();
        $uploaded->path = $stored;
        $uploaded->url = Storage::disk(config('uploader.disk'))->url($stored);

        return $uploaded;
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
        $path = $directory ?? config('uploader.directory');

        $clientOriginalName = explode('/', $url);
        $fileName = time() . '_' . array_pop($clientOriginalName);

        $stored = Storage::disk(config('uploader.disk'))->put($path . '/' . $fileName, $response->body());

        $uploaded = new Uploaded();
        $uploaded->path = $stored;
        $uploaded->url = Storage::disk(config('uploader.disk'))->url($stored);

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
