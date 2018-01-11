<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class UpdateUserTable extends BaseMigration
{
    protected $table = 'user';

    protected $mode = 'update';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->text('avatar')->nullable()->comment('大頭像');
            $table->text('trivial')->nullable()->comment('存遠端主機送來的使用者資訊');
        };
    }
}
