<?php

namespace Modules\Shop\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class ImagePreviewUpload extends BaseFormRequest
{
    public function rules()
    {
        return [
            'shop_id' => $this->idValidate('shop', 'id'),
            'image' => 'required|image|mimes:jpg,jpeg|dimensions:max_width=1024,max_height=500',
        ];
    }
}
