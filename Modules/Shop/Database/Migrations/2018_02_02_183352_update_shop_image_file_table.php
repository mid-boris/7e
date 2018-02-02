<?php
use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class UpdateShopImageFileTable extends BaseMigration
{
    protected $table = 'shop_image_file';

    protected $tableComment = '新增外鍵關聯';

    protected $mode = 'update';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->foreign('shop_id')
                ->references('id')->on('shop')
                ->onDelete('cascade');
        };
    }
}
