<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class DiscountDelete extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => $this->idValidate('discount'),
        ];
    }
}
