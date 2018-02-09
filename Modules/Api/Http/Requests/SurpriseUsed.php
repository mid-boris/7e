<?php

namespace Modules\Api\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class SurpriseUsed extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => $this->idValidate('user_surprise_item', 'id'),
        ];
    }
}
