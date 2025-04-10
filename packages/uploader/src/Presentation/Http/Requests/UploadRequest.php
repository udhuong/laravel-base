<?php

namespace Udhuong\Uploader\Presentation\Http\Requests;

use Udhuong\LaravelCommon\Presentation\Http\Requests\ApiRequest;

class UploadRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'files' => 'nullable|array|min:1|max:5',
            'files.*' => 'required|file|max:' . config('uploader.max_file_size', 1024 * 1024 * 10),
            'urls' => 'nullable|array|min:1|max:5|distinct',
            'urls.*' => 'required|url',
        ];
    }
}
