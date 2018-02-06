<?php

namespace Modules\Template\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Announcement\Constants\AnnouncementConstants;
use Modules\Base\Contract\FormRequest\BaseFormRequest;

class Announcement extends BaseFormRequest
{
    public function rules()
    {
        return [
            'type' => [
                'sometimes',
                'integer',
                'nullable',
                Rule::in(AnnouncementConstants::getAll()),
            ],
        ];
    }
}
