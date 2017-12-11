<?php

namespace Modules\Area\Entities;

/**
 * @property integer id
 * @property integer parent_id
 * @property string name
 */
class Area extends AreaBaseModel
{
    protected $table = 'area';

    protected $fillable = [
        'parent_id', 'name',
    ];

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }
}
