<?php

namespace Modules\Api\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class UserEdit extends BaseFormRequest
{
    public function rules()
    {
        return [
            'user_id' => $this->idValidate('user', 'id'),
            'nick_name' => 'required|string|max:16',
            'email' => 'required|string',
            'phone' => 'required|string|size:10',
            'gender' => 'required|integer|in:0,1',
            'area_id' => $this->idValidate('area', 'id'),
        ];
    }
}
