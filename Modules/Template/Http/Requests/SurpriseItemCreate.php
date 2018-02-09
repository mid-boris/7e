<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class SurpriseItemCreate extends BaseFormRequest
{
    public function rules()
    {
        return [
            'surprise_box_id' => $this->idValidate('surprise_box', 'id'),
            'name' => 'required|string|max:32',
            'description' => 'required|string|max:255',
            'expiration' => 'sometimes|integer|nullable|min:1',
        ];
    }
}
