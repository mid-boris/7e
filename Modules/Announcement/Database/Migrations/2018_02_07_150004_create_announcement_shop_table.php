<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateAnnouncementShopTable extends BaseMigration
{
    protected $table = 'announcement_shop';

    protected $tableComment = '和商家的關連表 tag用';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('announcement_id');
            $table->unsignedInteger('shop_id');

            $table->index('announcement_id', 'idx_announcement_id');
            $table->index('shop_id', 'idx_shop_id');
            $table->unique(['announcement_id', 'shop_id'], 'idx_announcement_shop_id');

            $table->foreign('announcement_id')
                ->references('id')->on('announcement')
                ->onDelete('cascade');
            $table->foreign('shop_id')
                ->references('id')->on('shop')
                ->onDelete('cascade');
        };
    }
}
