<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateImageFileTable extends BaseMigration
{
    protected $table = 'image_file';

    protected $tableComment = '管理圖片存放位置的表';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->string('saved_uri')->comment('儲存路徑');
            $table->unsignedInteger('image_size')->default(0);
            $table->unsignedInteger('image_width')->default(0);
            $table->unsignedInteger('image_height')->default(0);

            $table->timestamps();
        };
    }
}
