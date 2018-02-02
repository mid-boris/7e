<?php
namespace Modules\Announcement\Entities;


class AnnouncementContent extends BaseAnnouncement
{
    protected $table = 'announcement_content';

    protected $fillable = [
        'language', 'title', 'content',
    ];
}
