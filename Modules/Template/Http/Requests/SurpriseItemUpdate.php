<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class SurpriseItemUpdate extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => $this->idValidate('surprise_item', 'id'),
            'name' => 'required|string|max:32',
            'description' => 'required|string|max:255',
            'expiration' => 'sometimes|integer|nullable|min:1',
        ];
    }
}
