<?php
namespace Modules\Area\Entities;

class GoogleArea extends AreaBaseModel
{
    protected $table = 'google_area';

    protected $fillable = [
        'shop_id', 'name'
    ];
}
