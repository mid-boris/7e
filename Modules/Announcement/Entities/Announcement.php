<?php

namespace Modules\Announcement\Entities;

use Modules\Image\Entities\ImageFile;
use Modules\Shop\Entities\Shop;

class Announcement extends BaseAnnouncement
{
    protected $table = 'announcement';

    protected $fillable = [
        'high_light', 'type', 'status', 'start_time', 'end_time',
    ];

    public function content()
    {
        return $this->hasMany(AnnouncementContent::class, 'announcement_id');
    }

    public function images()
    {
        return $this->belongsToMany(ImageFile::class, 'announcement_image_file', 'announcement_id', 'image_id')
            ->orderBy('id');
    }

    public function shop()
    {
        return $this->belongsToMany(Shop::class, 'announcement_shop', 'announcement_id', 'shop_id');
    }

    public function shopReferStatus()
    {
        return $this->shop()->where('status', 1);
    }
}
