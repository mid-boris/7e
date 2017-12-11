<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class CreateUserRoleTable extends BaseMigration
{
    protected $table = 'user_role';

    protected $tableComment = '帳號角色';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('role_id');

            $table->index('user_id');
            $table->index('role_id');
        };
    }
}
