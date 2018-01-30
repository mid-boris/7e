<?php

namespace Modules\Api\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class NearByShop extends BaseFormRequest
{
    public function rules()
    {
        return [
            'lat' => ['required','regex:/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}$/'],
            'lng' => ['required','regex:/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,6}$/'],
            'radius' => 'required|integer|min:1|max:30',
        ];
    }
}
