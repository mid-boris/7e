<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateVoteItemTable extends BaseMigration
{
    protected $table = 'vote_item';

    protected $tableComment = '紀錄使用者和投票項目的關聯';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('article_id');
            $table->unsignedInteger('vote_id');
            $table->unsignedInteger('user_id');

            $table->timestamps();

            $table->index(['article_id', 'user_id']);
            $table->index(['user_id', 'vote_id']);
            $table->index(['vote_id', 'user_id']);
        };
    }
}
