<?php
namespace Modules\Forum\Repositories;

use Modules\Entrust\Utilities\SessionManager;
use Modules\Forum\Entities\Vote;

class VoteRepository extends ForumBaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }
}
