<?php

namespace Modules\Api\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Announcement\Constants\AnnouncementConstants;
use Modules\Base\Contract\FormRequest\BaseFormRequest;

class UserEdit extends BaseFormRequest
{
    public function rules()
    {
        return [
            'user_id' => $this->idValidate('user', 'id'),
            'nick_name' => 'required|string|max:16',
            'email' => 'required|string',
            'phone' => 'required|string|size:10',
            'gender' => 'required|integer|in:0,1',
            'area_id' => $this->idValidate('area', 'id'),
            'language' => [
                'required',
                'string',
                Rule::in(AnnouncementConstants::getSupportLanguageCodes()),
            ],
        ];
    }
}
