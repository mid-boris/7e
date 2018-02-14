<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreatePushTable extends BaseMigration
{
    protected $table = 'push';

    protected $tableComment = '紀錄推播訊息';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->text('content');

            $table->unsignedInteger('user_id');
            $table->string('user_account');

            $table->timestamps();
        };
    }
}
