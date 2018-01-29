<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class Shop extends BaseFormRequest
{
    public function rules()
    {
        return [
            'fuzzy_name' => 'sometimes|string|nullable',
        ];
    }
}
