<?php

namespace Udhuong\Uploader\Presentation\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Udhuong\LaravelCommon\Presentation\Http\Controllers\Controller;
use Udhuong\Uploader\Facades\Upload;
use Udhuong\Uploader\Presentation\Http\Requests\UploadRequest;
use Udhuong\Uploader\Presentation\Http\Requests\UploadFromLinkRequest;

class UploadController extends Controller
{
    /**
     * Upload file cơ bản
     *
     * @param UploadRequest $request
     * @return JsonResponse
     */
    public function upload(UploadRequest $request): JsonResponse
    {
        $files = $request->file('files');
        $uploadedFiles = [];
        foreach ($files as $file) {
            $uploadedFiles[] = Upload::uploadFile($file);
        }

        return response()->json([
            'status' => 'success',
            'data' => $uploadedFiles,
        ]);
    }

    /**
     * Upload file từ link
     *
     * @param UploadFromLinkRequest $request
     * @return JsonResponse
     */
    public function uploadFromLink(UploadFromLinkRequest $request): JsonResponse
    {

    }
}
