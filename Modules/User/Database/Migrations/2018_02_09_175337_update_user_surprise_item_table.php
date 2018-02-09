<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class UpdateUserSurpriseItemTable extends BaseMigration
{
    protected $table = 'user_surprise_item';

    protected $tableComment = '新增需要判斷的欄位';

    protected $mode = 'update';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->unsignedInteger('manufacture')->comment('製造日期');
            $table->unsignedTinyInteger('used')->default(0);
            $table->unsignedInteger('expiration_date_time')->nullable();
        };
    }
}
