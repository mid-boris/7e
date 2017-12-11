<?php

namespace Modules\Template\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Shop\Repositories\ShopRepository;
use Modules\Template\Http\Requests\ShopCreate;
use Modules\Template\Http\Requests\ShopDelete;
use Modules\Template\Http\Requests\ShopUpdate;

class ShopController extends Controller
{
    /** @var ShopRepository  */
    protected $shopRepo;

    public function __construct(ShopRepository $shopRepository)
    {
        $this->shopRepo = $shopRepository;
    }

    public function create(ShopCreate $request)
    {
        $startTime = strtotime($request->input('start_time'));
        $endTime = strtotime($request->input('end_time'));
        $busHours = date('H:i:s', $startTime) . " ~ " . date('H:i:s', $endTime);
        $special = $request->input('special') ?? 0;
        $status = $request->input('status') ?? 0;
        $closedDay = $request->input('closed_day') ?? [];
        $areaId = $request->input('area_id');
        $shop = $this->shopRepo->create(
            $request->input('name'),
            $request->input('telphone'),
            $request->input('phone'),
            $busHours,
            $request->input('start_time'),
            $request->input('end_time'),
            $special,
            $status,
            $closedDay,
            $request->input('address'),
            null,
            null,
            $areaId
        );
        return redirect()->back();
    }

    public function update(ShopUpdate $request)
    {
        $startTime = strtotime($request->input('start_time'));
        $endTime = strtotime($request->input('end_time'));
        $busHours = date('H:i:s', $startTime) . " ~ " . date('H:i:s', $endTime);
        $special = $request->input('special') ?? 0;
        $status = $request->input('status') ?? 0;
        $closedDay = $request->input('closed_day') ?? [];
        $areaId = $request->input('area_id');
        $this->shopRepo->update(
            $request->input('id'),
            $request->input('name'),
            $request->input('telphone'),
            $request->input('phone'),
            $busHours,
            $request->input('start_time'),
            $request->input('end_time'),
            $special,
            $status,
            $closedDay,
            $request->input('address'),
            null,
            null,
            $areaId
        );
        return redirect()->back();
    }

    public function delete(ShopDelete $request)
    {
        $this->shopRepo->delete($request->input('id'));
        return redirect()->back();
    }
}
