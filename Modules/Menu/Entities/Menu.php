<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Shop\Entities\Shop;

class Menu extends Model
{
    protected $table = 'menu';

    protected $fillable = [
        'shop_id', 'parent_id',
        'name', 'price', 'vegetarian', 'height_light', 'hot',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function children()
    {
        return $this->hasMany(static::class);
    }

    public function parent()
    {
        return $this->belongsTo(static::class);
    }
}
