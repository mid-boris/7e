<?php

namespace Modules\Api\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class ShopDecFavorite extends BaseFormRequest
{
    public function rules()
    {
        return [
            'shop_id' => $this->idValidate('shop', 'id'),
        ];
    }
}
