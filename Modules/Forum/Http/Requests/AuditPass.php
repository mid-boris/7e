<?php

namespace Modules\Forum\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class AuditPass extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => $this->getExists('article'),
        ];
    }
}
