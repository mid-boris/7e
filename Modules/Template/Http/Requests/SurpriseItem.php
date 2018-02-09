<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class SurpriseItem extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => $this->idValidate('surprise_box'),
        ];
    }
}
