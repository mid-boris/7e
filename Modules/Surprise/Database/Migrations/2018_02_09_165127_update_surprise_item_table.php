<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class UpdateSurpriseItemTable extends BaseMigration
{
    protected $table = 'surprise_item';

    protected $tableComment = '驚喜箱內容加入軟刪除';

    protected $mode = 'update';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->softDeletes();
        };
    }
}
