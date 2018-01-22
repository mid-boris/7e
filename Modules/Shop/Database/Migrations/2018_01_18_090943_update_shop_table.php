<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class UpdateShopTable extends BaseMigration
{
    protected $table = 'shop';

    protected $tableComment = '新增商家的經緯度';

    protected $mode = 'update';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->float('shop_lat')->default(0);
            $table->float('shop_lng')->default(0);
            $table->dropColumn('x');
            $table->dropColumn('y');
        };
    }
}
