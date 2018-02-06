<?php

namespace Modules\Template\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Contract\FormRequest\BaseFormRequest;
use Modules\Shop\Constants\DiscountTypeConstants;

class DiscountCreate extends BaseFormRequest
{
    public function rules()
    {
        return [
            'shop_id' => $this->idValidate('shop', 'id'),
            'type' => [
                'required',
                'integer',
                Rule::in(DiscountTypeConstants::all()),
            ],
            'menu_id' => $this->sometimesIdValidate('menu', 'id'),
            'age' => [
                'sometimes',
                'integer',
                'min:1',
                'max:128',
            ],
            'action' => [
                'sometimes',
                'required',
                'string',
                Rule::in(['+', '-', 'x']),
            ],
            'numeric' => 'sometimes|required|numeric',
            'custom' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|integer|in:0,1',
            'start_time' => 'sometimes|string|nullable',
            'end_time' => 'sometimes|string|nullable',
        ];
    }
}
