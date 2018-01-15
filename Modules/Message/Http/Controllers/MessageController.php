<?php

namespace Modules\Message\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Message\Http\Requests\MessageCreate;
use Modules\Message\Http\Requests\MessageIndex;
use Modules\Message\Repository\MessageRepository;

class MessageController extends Controller
{
    /** @var  MessageRepository */
    private $repository;

    public function __construct(MessageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(MessageIndex $request)
    {
        $account = $request->input('account');
        $results = $this->repository->getByFuzzy($account);
        return BaseResponse::response(['data' => $results]);
    }

    public function list()
    {
        $results = $this->repository->getLoginUserMessages();
        return BaseResponse::response(['data' => $results]);
    }

    public function create(MessageCreate $request)
    {
        $content = $request->input('content');
        $target = $request->input('target') ?? null;
        $this->repository->createContent($content, $target);
        return BaseResponse::response(['data' => true]);
    }
}
