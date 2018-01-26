<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateShopImageFileTable extends BaseMigration
{
    protected $table = 'shop_image_file';

    protected $tableComment = '商店 圖片 關聯表';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('shop_id');
            $table->unsignedInteger('image_id');

            $table->unsignedTinyInteger('trademark')->comment('是否為商標');

            $table->index('shop_id', 'idx_shop_id');
            $table->index('image_id', 'idx_image_id');
            $table->index('trademark', 'idx_trademark');
        };
    }
}
