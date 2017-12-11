<?php

namespace Modules\Template\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class SystemPermission extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role' => 'required|numeric|min:1',
            'node' => 'sometimes|required|array',
            'node.*' => 'sometimes|required|integer|min:1',
        ];
    }
}
