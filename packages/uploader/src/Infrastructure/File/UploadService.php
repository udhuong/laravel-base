<?php

namespace Udhuong\Uploader\Infrastructure\File;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadService
{
    private string $directory;
    private string $disk;

    public function directory(string $directory): self
    {
        $this->directory = $directory;
        return $this;
    }

    public function disk(string $disk): self
    {
        $this->disk = $disk;
        return $this;
    }

    /**
     * Upload xong trả về path tương đối dạng: uploads/1744276573_file_example_MP4_480_1_5MG.mp4
     * @param UploadedFile $file
     * @return string
     */
    public function uploadFile(UploadedFile $file): string
    {
        $fileName = $this->createFileName($file);
        return Storage::disk($this->disk)->putFileAs($this->directory, $file, $fileName);
    }

    /**
     * @param string $url
     * @return string
     * @throws ConnectionException
     */
    public function uploadFromUrl(string $url): string
    {
        $response = Http::get($url);
        if (!$response->successful()) {
            throw new ConnectionException('Unable to connect to the URL');
        }

        $path = $this->directory . '/' . $this->createFileName($url);
        Storage::disk($this->disk)->put($path, $response->body());

        return $path;
    }

    /**
     * @param string $url
     * @return string
     * @throws ConnectionException
     */
    public function uploadSinkFromUrl(string $url): string
    {
        $fileName = $this->createFileName($url);

        $tempPath = storage_path("app/{$fileName}");
        $response = Http::sink($tempPath)->get($url);
        if (!$response->successful()) {
            throw new ConnectionException('Unable to connect to the URL');
        }

        $fileStream = fopen($tempPath, 'rb');
        $path = $this->directory . '/' . $fileName;
        Storage::disk($this->disk)->put($path, $fileStream);

        fclose($fileStream);
        unlink($tempPath);

        return $path;
    }

    /**
     * @param string|UploadedFile $file
     * @return string
     */
    private function createFileName(string|UploadedFile $file): string
    {
        $fileName = '';
        if ($file instanceof UploadedFile) {
            $fileName = $file->getClientOriginalName();
        }
        if(is_string($file)) {
            $clientOriginalName = explode('/', $file);
            $fileName = array_pop($clientOriginalName);
        }
        return time(). '_' . Str::random(8) . '_' . $fileName;
    }
}
