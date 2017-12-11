<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Constants\ConnectionConfigConstants;
use Modules\Base\Contract\FormRequest\BaseFormRequest;

class ForumDelete extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer|min:3|exists:' . ConnectionConfigConstants::MAIN_CONNECTION_NAME . '.forum',
        ];
    }
}
