<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateMenuTable extends BaseMigration
{
    protected $table = 'menu';

    protected $tableComment = '菜單';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('shop_id')->nullable();
            $table->unsignedInteger('parent_id')->nullable();

            $table->string('name', 128);
            $table->double('price')->nullable();
            $table->unsignedTinyInteger('vegetarian')->default(0)->comment('素食');
            $table->unsignedTinyInteger('status')->default(1);

            $table->timestamps();
        };
    }
}
