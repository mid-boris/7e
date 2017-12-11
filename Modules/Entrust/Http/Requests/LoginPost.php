<?php

namespace Modules\Entrust\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class LoginPost extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user' => 'required|max:32',
            'password' => 'required|max:32',
        ];
    }
}
