<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class UpdateShopTable extends BaseMigration
{
    protected $table = 'shop';

    protected $tableComment = '新增商家類型';

    protected $mode = 'update';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->unsignedTinyInteger('shop_type')->default(0)->comment('商家類型: 1食 2衣 3住 4行 5育 6樂');
        };
    }
}
