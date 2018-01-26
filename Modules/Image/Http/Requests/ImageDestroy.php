<?php

namespace Modules\Image\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class ImageDestroy extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => $this->idValidate('image_file'),
        ];
    }
}
