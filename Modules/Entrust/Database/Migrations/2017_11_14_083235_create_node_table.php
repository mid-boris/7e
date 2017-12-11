<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateNodeTable extends BaseMigration
{
    protected $table = 'node';

    protected $tableComment = '節點';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('parent_id')->nullable()->comment('母節點id');
            $table->string('name', 16);
            $table->string('uri')->nullable();
            $table->string('icon_class')->default('fa-circle-o');
            $table->unsignedTinyInteger('visible')->comment('是否要顯示於前台')->default(1);

            $table->timestamps();

            $table->index('name');
            $table->index('parent_id');
        };
    }
}
