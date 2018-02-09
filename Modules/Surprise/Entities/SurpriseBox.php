<?php

namespace Modules\Surprise\Entities;

class SurpriseBox extends SurpriseBaseModel
{
    protected $table = 'surprise_box';

    protected $fillable = [
        'name', 'start_time', 'end_time', 'status',
    ];

    public function item()
    {
        return $this->hasMany(SurpriseItem::class, 'surprise_box_id');
    }
}
