<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class UpdateArticleTable extends BaseMigration
{
    protected $table = 'article';

    protected $tableComment = '加入 __ ';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->unsignedInteger('vote_end_time')->nullable()->comment('投票結束時間');
        };
    }
}
