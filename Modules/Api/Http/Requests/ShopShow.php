<?php

namespace Modules\Api\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class ShopShow extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => $this->idValidate('shop'),
        ];
    }
}
