<?php

namespace Udhuong\Uploader\Presentation\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Udhuong\LaravelCommon\Presentation\Http\Controllers\Controller;
use Udhuong\LaravelCommon\Presentation\Http\Response\Responder;
use Udhuong\Uploader\Domain\Actions\SaveMediaAction;
use Udhuong\Uploader\Presentation\Facades\Upload;
use Udhuong\Uploader\Presentation\Http\Requests\UploadRequest;

class UploadController extends Controller
{
    public function __construct(
        private readonly SaveMediaAction $saveMediaAction,
    )
    {
    }

    /**
     * Upload file cơ bản
     *
     * @param UploadRequest $request
     * @return JsonResponse
     * @throws ConnectionException
     */
    public function upload(UploadRequest $request): JsonResponse
    {
        $files = $request->file('files', []);
        $urls = $request->get('urls', []);
        $uploadedFiles = [];

        foreach ($files as $file) {
            $media = Upload::uploadFile($file);
            dd($media);
            $this->saveMediaAction->handle($media);
            $uploadedFiles[] = $media;
        }
        foreach ($urls as $url) {
            $media = Upload::uploadSinkFromUrl($url);
            $this->saveMediaAction->handle($media);
            $uploadedFiles[] = $media;
        }

        return Responder::success($uploadedFiles, 'Upload thành công');
    }
}
