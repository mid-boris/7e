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
        ];
    }
}
