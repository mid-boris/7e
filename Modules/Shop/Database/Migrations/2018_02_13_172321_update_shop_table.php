<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class UpdateShopTable extends BaseMigration
{
    protected $table = 'shop';

    protected $tableComment = '新增商家推至首頁的選項';

    protected $mode = 'update';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->unsignedTinyInteger('sendToTop')->default(0)->comment('會顯示於app端的首頁');
        };
    }
}
