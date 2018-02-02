<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateAnnouncementTable extends BaseMigration
{
    protected $table = 'announcement';

    protected $tableComment = '公告本體';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedTinyInteger('status')->default(1)->comment('狀態');
            $table->unsignedTinyInteger('type')->comment('類型, 1.輪播 2.跑馬燈 3.公告');

            $table->unsignedTinyInteger('high_light')->default(0)->comment('置頂');

            $table->unsignedTinyInteger('start_time')->nullable()->comment('開始時間');
            $table->unsignedTinyInteger('end_time')->nullable()->comment('結束時間');

            $table->timestamps();
        };
    }
}
