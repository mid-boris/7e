<?php
namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Api\Http\Requests\AreaIndex;
use Modules\Area\Repositories\AreaRepository;
use Modules\Base\Utilities\Response\BaseResponse;

class AreaController extends Controller
{
    public function index(AreaIndex $request)
    {
        $parentId = $request->input('parent_id');
        /** @var AreaRepository $areaRepo */
        $areaRepo = app()->make(AreaRepository::class);
        $results = $areaRepo->getWithChildrenCount($parentId);
        return BaseResponse::response($results);
    }
}
