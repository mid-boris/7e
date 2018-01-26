<?php

namespace Modules\Image\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Image\Http\Requests\ImageDestroy;
use Modules\Image\Repositories\ImageRepository;

class ImageController extends Controller
{
    public function destroy(ImageDestroy $request)
    {
        $imgId = $request->input('id');
        $imgRepo = app()->make(ImageRepository::class);
        $imgRepo->delete($imgId);
        return redirect()->back();
    }
}
