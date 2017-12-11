<?php

namespace Modules\Entrust\Entities;

/**
 * @property mixed id
 */
class Node extends EntrustBaseModel
{
    protected $table = 'node';

    protected $fillable = [
        'parent_id', 'name', 'icon_class', 'uri',
    ];

    public function permission()
    {
        return $this->hasMany(NodePermission::class, 'node_id', 'id');
    }
}
