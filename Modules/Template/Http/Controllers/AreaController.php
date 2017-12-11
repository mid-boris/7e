<?php

namespace Modules\Template\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Area\Repositories\AreaRepository;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Template\Http\Requests\AreaCreate;
use Modules\Template\Http\Requests\AreaDelete;
use Modules\Template\Http\Requests\AreaGetByName;
use Modules\Template\Http\Requests\AreaUpdate;

class AreaController extends Controller
{
    /** @var AreaRepository  */
    private $areaRepo;

    public function __construct(AreaRepository $areaRepository)
    {
        $this->areaRepo = $areaRepository;
    }

    public function getByNameWithParentData(AreaGetByName $request)
    {
        $name = $request->input('name');
        $results = $this->areaRepo->getByNameWithFuzzy($name);
        return BaseResponse::response([
            'data' => $results,
        ]);
    }

    public function create(AreaCreate $request)
    {
        $name = $request->input('name');
        $parentName = $request->input('parent_name');
        $status = $request->input('status') ?? 0;
        $this->areaRepo->create($name, $parentName, $status);
        return redirect()->back();
    }

    public function update(AreaUpdate $request)
    {
        $status = $request->input('status') ?? 0;
        $this->areaRepo->update($request->input('id'), $request->input('name'), $status);
        return redirect()->back();
    }

    public function delete(AreaDelete $request)
    {
        $this->areaRepo->delete($request->input('id'));
        return redirect()->back();
    }
}
