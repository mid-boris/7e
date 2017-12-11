<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class CreateRoleNodeTable extends BaseMigration
{
    protected $table = 'role_node';

    protected $tableComment = '角色和節點關係';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('role_id');
            $table->unsignedInteger('node_id');

            $table->index('role_id');
            $table->index('node_id');
        };
    }
}
