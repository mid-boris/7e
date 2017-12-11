<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class AccountCreate extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account' => 'required|string|max:32',
            'password' => 'required|string|max:32',
            'nick_name' => 'required|string|max:16',
            'status' => 'sometimes|required|in:1',
            'role' => 'required|numeric|min:0',
        ];
    }
}
