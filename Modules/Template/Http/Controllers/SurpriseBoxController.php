<?php

namespace Modules\Template\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Surprise\Repositories\SurpriseRepository;
use Modules\Template\Http\Requests\SurpriseBoxCreate;
use Modules\Template\Http\Requests\SurpriseBoxDelete;
use Modules\Template\Http\Requests\SurpriseBoxUpdate;

class SurpriseBoxController extends Controller
{
    /** @var SurpriseRepository  */
    private $repo;

    public function __construct(SurpriseRepository $surpriseRepository)
    {
        $this->repo = $surpriseRepository;
    }

    public function create(SurpriseBoxCreate $request)
    {
        $data = $request->all();
        $data['status'] = $data['status'] ?? 0;
        $this->repo->create($data);
        return redirect()->back();
    }

    public function update(SurpriseBoxUpdate $request)
    {
        $data = $request->all();
        $data['status'] = $data['status'] ?? 0;
        $this->repo->update($data, $request->input('id'));
        return redirect()->back();
    }

    public function delete(SurpriseBoxDelete $request)
    {
        $this->repo->delete($request->input('id'));
        return redirect()->back();
    }
}
