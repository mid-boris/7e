<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class CreateAreaTable extends BaseMigration
{
    protected $table = 'area';

    protected $tableComment = '地區';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('parent_id')->nullable()->comment('母地區');
            $table->string('name', 128)->comment('地區名稱');
            $table->unsignedTinyInteger('status')->default(1)->comment('啟用狀態');

            $table->timestamps();

            $table->index('parent_id');
            $table->index('name');
        };
    }
}
