<?php

namespace Modules\Menu\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class MenuUpdate extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => $this->idValidate('menu'),
            'name' => 'required|string|max:32',
            'price' => 'sometimes|numeric|nullable|min:0',
            'status' => 'sometimes|required|in:1',
            'vegetarian' => 'sometimes|required|in:1',
            'height_light' => 'sometimes|required|in:1',
            'hot' => 'sometimes|required|in:1',
        ];
    }
}
