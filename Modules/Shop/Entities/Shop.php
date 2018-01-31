<?php

namespace Modules\Shop\Entities;

use Modules\Area\Entities\Area;
use Modules\Area\Entities\GoogleArea;
use Modules\Image\Entities\ImageFile;
use Modules\Menu\Entities\Menu;

/**
 * Class Shop
 * @property int id
 * @property string name
 * @package Modules\Shop\Entities
 */
class Shop extends ShopBaseModel
{
    protected $table = 'shop';

    protected $fillable = [
        'name', 'telphone', 'phone', 'business_hours',
        'business_hours_start_time', 'business_hours_end_time',
        'special', 'area_id', 'address', 'closed_day', 'i_pass',
        'shop_lat', 'shop_lng', 'shop_type',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'shop_lat', 'shop_lng',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class)->with(['parent']);
    }

    public function googleArea()
    {
        return $this->hasMany(GoogleArea::class, 'shop_id');
    }

    public function menu()
    {
        return $this->hasMany(Menu::class, 'shop_id')->where('status', 1)->orderByDesc('height_light');
    }

    public function images()
    {
        return $this->belongsToMany(ImageFile::class, 'shop_image_file', 'shop_id', 'image_id');
    }

    public function trademark()
    {
        return $this
            ->belongsToMany(ImageFile::class, 'shop_image_file', 'shop_id', 'image_id')
            ->wherePivot('trademark', 1);
    }

    public function preview()
    {
        return $this
            ->belongsToMany(ImageFile::class, 'shop_image_file', 'shop_id', 'image_id')
            ->wherePivot('trademark', 0);
    }
}
