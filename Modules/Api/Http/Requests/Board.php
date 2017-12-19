<?php

namespace Modules\Api\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class Board extends BaseFormRequest
{
    public function rules()
    {
        return [
            'forum_id' => [
                'sometimes',
                'integer',
                'min:1',
                $this->getExists('forum', 'id'),
            ],
        ];
    }
}
