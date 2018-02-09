<?php

namespace Modules\Template\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Surprise\Repositories\SurpriseItemRepository;
use Modules\Template\Http\Requests\SurpriseItemCreate;
use Modules\Template\Http\Requests\SurpriseItemDelete;
use Modules\Template\Http\Requests\SurpriseItemUpdate;

class SurpriseItemController extends Controller
{
    /** @var SurpriseItemRepository  */
    private $repo;

    public function __construct(SurpriseItemRepository $surpriseRepository)
    {
        $this->repo = $surpriseRepository;
    }

    public function create(SurpriseItemCreate $request)
    {
        $data = $request->all();
        $this->repo->create($data);
        return redirect()->back();
    }

    public function update(SurpriseItemUpdate $request)
    {
        $data = $request->all();
        $this->repo->update($data, $request->input('id'));
        return redirect()->back();
    }

    public function delete(SurpriseItemDelete $request)
    {
        $this->repo->delete($request->input('id'));
        return redirect()->back();
    }
}
