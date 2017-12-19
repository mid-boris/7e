<?php

namespace Modules\Api\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class AreaIndex extends BaseFormRequest
{
    public function rules()
    {
        return [
            'parent_id' => [
                'sometimes',
                'integer',
                'min:1',
                $this->getExists('area', 'id'),
            ],
        ];
    }
}
