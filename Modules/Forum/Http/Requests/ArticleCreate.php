<?php

namespace Modules\Forum\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class ArticleCreate extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:128',
            'content' => 'required|string',
            'forum_id' => $this->idValidate('forum', 'id'),
            'parent_id' => [
                'sometimes',
                'integer',
                'min:1',
                $this->getExists('article', 'id'),
            ],
            'vote_max_count' => 'sometimes|integer|nullable|min:1',
            'vote_option' => 'sometimes|array|min:1|max:10',
            'vote_option.*' => 'sometimes|string|max:32',
            'vote_end_time' => 'sometimes|integer',
            'image' => 'array',
            'image.*' => 'image|mimes:jpg,jpeg|dimensions:max_width=1024,max_height=1024',
        ];
    }
}
