<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Constants\ConnectionConfigConstants;
use Modules\Base\Contract\FormRequest\BaseFormRequest;

class AreaUpdate extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer|min:1|exists:' . ConnectionConfigConstants::MAIN_CONNECTION_NAME . '.area',
            'name' => 'required|string|min:1|max:128',
            'status' => 'sometimes|required|in:1'
        ];
    }
}
