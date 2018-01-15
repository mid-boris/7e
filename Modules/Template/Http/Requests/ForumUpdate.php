<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Constants\ConnectionConfigConstants;
use Modules\Base\Contract\FormRequest\BaseFormRequest;

class ForumUpdate extends BaseFormRequest
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
            'name' => 'required|string|min:1|max:128',
            'status' => 'sometimes|required|in:1',
            'audit' => 'sometimes|required|in:1',
            'sort' => 'sometimes|required|integer',
        ];
    }
}
