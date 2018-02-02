<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class UpdateAnnouncementTable extends BaseMigration
{
    protected $table = 'announcement';

    protected $tableComment = '修正時間欄位的錯誤';

    protected $mode = 'update';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->unsignedInteger('start_time')->nullable()->change();
            $table->unsignedInteger('end_time')->nullable()->change();
        };
    }
}
