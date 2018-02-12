<?php

namespace Modules\Template\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Base\Constants\ConnectionConfigConstants;
use Modules\Base\Contract\FormRequest\BaseFormRequest;

class AccountUpdate extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => [
                'required',
                'integer',
                'min:1',
                Rule::exists(ConnectionConfigConstants::MAIN_CONNECTION_NAME.'.user')->where(function ($query) {
                    /** @var \Illuminate\Database\Eloquent\Builder $query */
                    $query->where('id', '!=', 1);
                }),
            ],
            'account' => 'required|string|max:32',
            'password' => 'required|string|max:32',
            'nick_name' => 'required|string|max:16',
            'status' => 'sometimes|required|in:1',
            'role' => 'required|numeric|min:0',
            'email' => 'required|string',
            'phone' => 'required|string|size:10',
            'gender' => 'required|integer|in:0,1',
        ];
    }
}
