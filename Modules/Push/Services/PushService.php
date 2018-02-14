<?php
namespace Modules\Push\Services;

use Modules\Push\Entities\Push;
use Modules\RemoteSystem\Src\GoogleFireBase;

class PushService
{
    public function list()
    {
        $results = Push::orderByDesc('id')
            ->paginate(35);
        return $results;
    }

    public function create(array $data)
    {
        $push = Push::create($data);
        if ($push) {
            $this->send($data['title'], $data['content']);
        }
    }

    protected function send(string $title, string $content)
    {
        /** @var GoogleFireBase $fireBase */
        $fireBase = app()->make(GoogleFireBase::class);
        $fireBase->send($title, $content);
    }
}
