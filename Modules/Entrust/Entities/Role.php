<?php

namespace Modules\Entrust\Entities;

/**
 * @property mixed id
 */
class Role extends EntrustBaseModel
{
    protected $table = 'role';

    protected $fillable = [
        'name',
    ];

    public function node()
    {
        return $this->belongsToMany(Node::class, 'role_node');
    }

    public function nodeP()
    {
        return $this->hasMany(RoleNode::class);
    }
}
