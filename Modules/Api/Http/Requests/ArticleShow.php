<?php

namespace Modules\Api\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class ArticleShow extends BaseFormRequest
{
    public function rules()
    {
        return [
            'article_id' => $this->idValidate('article', 'id'),
        ];
    }
}
