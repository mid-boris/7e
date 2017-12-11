<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class Menu extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => 'sometimes|required|integer|min:1',
        ];
    }
}
