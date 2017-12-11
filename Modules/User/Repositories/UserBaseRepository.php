<?php

namespace Modules\User\Repositories;

use Modules\Base\Contract\Repository\BaseRepository;

abstract class UserBaseRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }
}
