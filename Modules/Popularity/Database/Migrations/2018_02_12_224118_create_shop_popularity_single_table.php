<?php
use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateShopPopularitySingleTable extends BaseMigration
{
    protected $table = 'shop_popularity_single';

    protected $tableComment = '商店不累積計數';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('shop_id');
            $table->unsignedInteger('day');

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('area_id')->nullable();
            $table->unsignedTinyInteger('gender')->nullable();

            $table->timestamps();

            $table->unique(['shop_id', 'day', 'user_id'], 'idx_shop_id_day_user_id');
            $table->index('shop_id', 'idx_shop_id');
            $table->index('day', 'idx_day');
            $table->index('user_id', 'idx_user_id');
            $table->index('area_id', 'idx_area_id');
            $table->index('gender', 'idx_gender');
        };
    }
}
