<?php

namespace Modules\Template\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Forum\Repositories\ForumRepository;
use Modules\Template\Http\Requests\ForumCreate;
use Modules\Template\Http\Requests\ForumDelete;
use Modules\Template\Http\Requests\ForumUpdate;

class ForumController extends Controller
{
    protected $forumRepo;

    public function __construct(ForumRepository $forumRepository)
    {
        $this->forumRepo = $forumRepository;
    }

    public function create(ForumCreate $request)
    {
        $name = $request->input('name');
        $parentId = $request->input('parent_id');
        $status = $request->input('status') ?? 0;
        $audit = $request->input('audit') ?? 0;
        $sort = $request->input('sort') ?? 0;
        $this->forumRepo->create($name, $parentId, $audit, $status, $sort);
        return redirect()->back();
    }

    public function update(ForumUpdate $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $status = $request->input('status') ?? 0;
        $audit = $request->input('audit') ?? 0;
        $sort = $request->input('sort') ?? 0;
        $this->forumRepo->update($id, $name, $audit, $status, $sort);
        return redirect()->back();
    }

    public function delete(ForumDelete $request)
    {
        $id = $request->input('id');
        $this->forumRepo->delete($id);
        return redirect()->back();
    }
}
