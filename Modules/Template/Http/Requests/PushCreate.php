<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class PushCreate extends BaseFormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string|max:128',
            'content' => 'required|string|max:255',
        ];
    }
}
