<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class ShopCreate extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:128',
            'address' => 'required|string|max:256',
            'telphone' => 'required|string|max:32',
            'phone' => 'required|string|max:32',
            'start_time' => 'required|string|max:64',
            'end_time' => 'required|string|max:64',
            'special' => 'sometimes|required|in:1',
            'status' => 'sometimes|required|in:1',
            'closed_day' => 'sometimes|required|array',
            'closed_day.*' => 'sometimes|required|integer|min:0',
            'area_id' => 'sometimes|required|integer|min:1',
        ];
    }
}
