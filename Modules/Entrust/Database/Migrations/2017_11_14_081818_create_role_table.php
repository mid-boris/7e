<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateRoleTable extends BaseMigration
{
    protected $table = 'role';

    protected $tableComment = '角色';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 16);

            $table->timestamps();

            $table->unique('name');
        };
    }
}
