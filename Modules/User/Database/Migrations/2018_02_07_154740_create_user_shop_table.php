<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class CreateUserShopTable extends BaseMigration
{
    protected $table = 'user_shop';

    protected $tableComment = '我的最愛商家';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('shop_id');

            $table->index('user_id', 'idx_user_id');
            $table->index('shop_id', 'idx_shop_id');
            $table->unique(['user_id', 'shop_id'], 'idx_user_shop_id');

            $table->foreign('user_id')
                ->references('id')->on('user')
                ->onDelete('cascade');
            $table->foreign('shop_id')
                ->references('id')->on('shop')
                ->onDelete('cascade');
        };
    }
}
