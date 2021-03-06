<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class MenuCreate extends BaseFormRequest
{
    public function rules()
    {
        return [
            'shop_id' => $this->idValidate('shop', 'id'),
            'name' => 'required|string|max:32',
            'price' => 'sometimes|numeric|nullable|min:0',
            'status' => 'sometimes|required|in:1',
            'vegetarian' => 'sometimes|required|in:1',
            'height_light' => 'sometimes|required|in:1',
            'hot' => 'sometimes|required|in:1',
        ];
    }
}
