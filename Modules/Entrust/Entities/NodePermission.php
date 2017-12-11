<?php

namespace Modules\Entrust\Entities;

class NodePermission extends EntrustBaseModel
{
    protected $table = 'node_permission';

    public $timestamps = false;

    protected $fillable = [];
}
