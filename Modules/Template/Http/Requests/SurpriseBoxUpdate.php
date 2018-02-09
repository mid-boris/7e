<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class SurpriseBoxUpdate extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => $this->idValidate('surprise_box'),
            'name' => 'required|string|max:32',
            'start_time' => 'sometimes|string|nullable',
            'end_time' => 'sometimes|string|nullable',
            'status' => 'sometimes|integer|in:0,1',
        ];
    }
}
