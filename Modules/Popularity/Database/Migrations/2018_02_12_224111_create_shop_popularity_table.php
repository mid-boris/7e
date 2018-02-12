<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class CreateShopPopularityTable extends BaseMigration
{
    protected $table = 'shop_popularity';

    protected $tableComment = '商店人氣計數';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('shop_id');
            $table->unsignedInteger('day');
            $table->unsignedInteger('accumulation_popularity')->comment('累積人氣, 會重複計數');

            $table->timestamps();

            $table->unique(['shop_id', 'day'], 'idx_shop_id_day');
            $table->index('shop_id', 'idx_shop_id');
            $table->index('day', 'idx_day');

            $table->foreign('shop_id')
                ->references('id')->on('shop')
                ->onDelete('cascade');
        };
    }
}
