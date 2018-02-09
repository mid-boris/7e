<?php

namespace Modules\Surprise\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;

class SurpriseItem extends SurpriseBaseModel
{
    use SoftDeletes;

    protected $table = 'surprise_item';

    protected $fillable = [
        'surprise_box_id', 'name', 'description', 'expiration',
    ];
}
