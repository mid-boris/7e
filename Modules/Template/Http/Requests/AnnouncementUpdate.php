<?php

namespace Modules\Template\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Announcement\Constants\AnnouncementConstants;
use Modules\Base\Contract\FormRequest\BaseFormRequest;

class AnnouncementUpdate extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => $this->idValidate('announcement'),
            'language' => [
                'required',
                'string',
                Rule::in(AnnouncementConstants::getSupportLanguageCodes()),
            ],
            'title' => 'required|string|max:256',
            'content' => 'required|string',
            'high_light' => 'sometimes|integer',
            'status' => 'sometimes|integer',
            'type' => 'required|integer',
            'image' => 'image|mimes:jpg,jpeg|dimensions:max_width=1024,max_height=500',
            'start_time' => 'sometimes|string|nullable',
            'end_time' => 'sometimes|string|nullable',
            'shop_id' => 'sometimes|array|nullable'
        ];
    }
}
