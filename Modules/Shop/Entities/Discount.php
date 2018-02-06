<?php
namespace Modules\Shop\Entities;

class Discount extends ShopBaseModel
{
    protected $table = 'discount';

    protected $fillable = [
        'shop_id', 'type', 'menu_id', 'age', 'action', 'numeric', 'custom', 'status', 'start_time', 'end_time',
    ];
}
