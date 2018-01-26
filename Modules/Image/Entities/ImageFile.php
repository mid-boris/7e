<?php

namespace Modules\Image\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string saved_uri
 * @property int image_size
 * @property  int image_width
 * @property  int image_height
 */
class ImageFile extends Model
{
    protected $table = 'image_file';

    protected $fillable = [
        'saved_uri', 'image_size',
    ];
}
