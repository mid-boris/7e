<?php

namespace Modules\Entrust\Repositories;

use Modules\Base\Contract\Repository\BaseRepository;

abstract class EntrustBaseRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }
}
