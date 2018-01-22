<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class MapInfo extends BaseFormRequest
{
    public function rules()
    {
        return [
            'address' => 'required|min:1|max:128|string',
        ];
    }
}
