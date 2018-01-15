<?php

namespace Modules\Message\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class MessageCreate extends BaseFormRequest
{
    public function rules()
    {
        return [
            'content' => 'required|string|max:255',
            'target' => 'sometimes|required|string|max:32',
        ];
    }
}
