<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class MenuCreate extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:128',
            'price' => 'sometimes|numeric|nullable|min:0',
            'status' => 'sometimes|required|in:1',
            'vegetarian' => 'sometimes|required|in:1',
        ];
    }
}
