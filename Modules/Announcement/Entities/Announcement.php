<?php

namespace Modules\Announcement\Entities;

use Modules\Image\Entities\ImageFile;

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
}
