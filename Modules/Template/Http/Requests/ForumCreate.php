<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class ForumCreate extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:1|max:128',
            'parent_id' => 'sometimes|integer|nullable',
            'status' => 'sometimes|required|in:1',
            'audit' => 'sometimes|required|in:1',
            'sort' => 'sometimes|required|integer',
        ];
    }
}
