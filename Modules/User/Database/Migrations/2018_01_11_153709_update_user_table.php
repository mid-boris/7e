<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class UpdateUserTable extends BaseMigration
{
    protected $table = 'user';

    protected $mode = 'update';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->mediumText('avatar')->nullable()->comment('大頭像');
            $table->text('trivial')->nullable()->comment('存遠端主機送來的使用者資訊');
        };
    }
}
