<?php

namespace Modules\Message\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class MessageIndex extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account' => 'sometimes|string|max:32',
        ];
    }
}
