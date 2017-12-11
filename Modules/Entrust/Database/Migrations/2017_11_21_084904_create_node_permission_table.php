<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class CreateNodePermissionTable extends BaseMigration
{
    protected $table = 'node_permission';

    protected $tableComment = '節點與路徑權限';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('node_id');
            $table->string('uri', 64);

            $table->index('node_id');
            $table->unique('uri');
        };
    }
}
