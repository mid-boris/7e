<?php

namespace Modules\Api\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class ReservationSend extends BaseFormRequest
{
    public function rules()
    {
        return [
            'shop_id' => $this->idValidate('shop', 'id'),
            'nick_name' => 'required|string|max:16',
            'phone' => 'required|string|max:32',
            'reservation_time' => 'required|integer',
            'number_of_people' => 'required|integer|min:1',
        ];
    }
}
