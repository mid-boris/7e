<?php

namespace Modules\Announcement\Http\Requests;

use Modules\Base\Contract\FormRequest\BaseFormRequest;

class AnnouncementDelete extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => $this->idValidate('announcement'),
        ];
    }
}
