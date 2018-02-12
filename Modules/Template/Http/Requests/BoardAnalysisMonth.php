<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class BoardAnalysisMonth extends BaseFormRequest
{
    public function rules()
    {
        return [
            'forum_id' => $this->idValidate('forum', 'id'),
        ];
    }
}
