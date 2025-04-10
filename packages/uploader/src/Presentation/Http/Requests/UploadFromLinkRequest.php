<?php

namespace Udhuong\Uploader\Presentation\Http\Requests;

use Udhuong\LaravelCommon\Presentation\Http\Requests\ApiRequest;

class UploadFromLinkRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'links' => 'required|array|min:1|max:5|distinct',
            'links.*' => 'required|url',
        ];
    }
}
