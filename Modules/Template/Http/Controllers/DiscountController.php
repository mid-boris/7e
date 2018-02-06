<?php

namespace Modules\Template\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Shop\Repositories\DiscountRepository;
use Modules\Template\Http\Requests\DiscountCreate;
use Modules\Template\Http\Requests\DiscountDelete;
use Modules\Template\Http\Requests\DiscountUpdate;

class DiscountController extends Controller
{
    /** @var DiscountRepository  */
    private $repo;

    public function __construct(DiscountRepository $discountRepository)
    {
        $this->repo = $discountRepository;
    }

    /**
     * Show the form for creating a new resource.
     * @param DiscountCreate $request
     * @return Response
     */
    public function create(DiscountCreate $request)
    {
        $data = $request->all();
        $this->repo->create($data);
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request|DiscountUpdate $request
     * @return Response
     */
    public function update(DiscountUpdate $request)
    {
        $this->repo->update($request->all(), $request->input('id'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param DiscountDelete $request
     * @return Response
     */
    public function delete(DiscountDelete $request)
    {
        $this->repo->delete($request->input('id'));
        return redirect()->back();
    }
}
