<?php
namespace Modules\Image\Repositories;

use Modules\Image\Entities\ImageFile;

class ImageRepository
{
    public function delete(int $imgId)
    {
        /** @var ImageFile $img */
        $img = ImageFile::find($imgId);
        if ($img) {
            $destinationPath = public_path('/images');
            $fileName = $img->saved_uri;
            $path = $destinationPath . "/{$fileName}";
            $deleted = \File::delete($path);
            if ($deleted) {
                $img->delete();
            }
        }
        return false;
    }
}
