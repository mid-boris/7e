<?php

namespace Modules\Shop\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class ImageTrademarkUpload extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shop_id' => $this->idValidate('shop', 'id'),
            'image' => 'required|image|mimes:jpeg,jpg|dimensions:max_width=256,max_height=256',
        ];
    }
}
