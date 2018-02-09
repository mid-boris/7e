<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class SurpriseItemDelete extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => $this->idValidate('surprise_item', 'id'),
        ];
    }
}
