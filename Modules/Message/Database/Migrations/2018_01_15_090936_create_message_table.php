<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateMessageTable extends BaseMigration
{
    protected $table = 'message';

    protected $tableComment = '類似站內信的訊息';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->string('content')->comment('訊息內文');

            $table->unsignedInteger('target_id')->comment('目標對象者id');
            $table->string('target_account', 32)->comment('目標對象者帳號');
            $table->string('target_nick_name', 16)->comment('目標對象者暱稱');

            $table->unsignedInteger('user_id')->comment('留言者id');
            $table->string('user_account', 32)->comment('留言者帳號');
            $table->string('user_nick_name', 16)->comment('留言者暱稱');

            $table->timestamps();

            $table->index('target_id', 'idx_target_id');
            $table->index('target_account', 'idx_target_account');
            $table->index('target_nick_name', 'idx_target_nick_name');
            $table->index('user_id', 'idx_user_id');
            $table->index('user_account', 'idx_user_account');
            $table->index('user_nick_name', 'idx_user_nick_name');
        };
    }
}
