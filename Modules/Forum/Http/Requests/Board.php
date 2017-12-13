<?php

namespace Modules\Forum\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class Board extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'parent_id' => 'sometimes|integer|min:1',
            'forum_id' => 'sometimes|integer|min:1',
        ];
    }
}
