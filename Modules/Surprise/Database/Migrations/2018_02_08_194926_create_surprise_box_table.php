<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateSurpriseBoxTable extends BaseMigration
{
    protected $table = 'surprise_box';

    protected $tableComment = '驚喜箱';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 32)->comment('該箱的名字');

            $table->unsignedInteger('start_time')->nullable();
            $table->unsignedInteger('end_time')->nullable();

            $table->unsignedTinyInteger('status')->default(0);

            $table->timestamps();

            $table->index('start_time', 'idx_start_time');
            $table->index('end_time', 'idx_end_time');
            $table->index('status', 'idx_status');
            $table->index(['start_time', 'end_time', 'status'], 'idx_start_end_time_status');
        };
    }
}
