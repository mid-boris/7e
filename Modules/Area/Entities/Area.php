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

    protected $hidden = [
        'status', 'created_at', 'updated_at',
    ];

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id')->where('status', 1);
    }
}
