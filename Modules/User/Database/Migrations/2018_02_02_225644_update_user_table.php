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
            $table->string('language', 16)->nullable()->comment('使用者語系');
        };
    }
}
