<?php

namespace Modules\Forum\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class VoteAdd extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vote_ids' => 'required|array|min:1',
            'vote_ids.*' => 'required|integer|min:1',
            'article_id' => $this->idValidate('article', 'id'),
        ];
    }
}
