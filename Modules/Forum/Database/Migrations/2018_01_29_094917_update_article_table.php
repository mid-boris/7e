<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class UpdateArticleTable extends BaseMigration
{
    protected $table = 'article';

    protected $mode = 'update';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->unsignedInteger('vote_end_time')->nullable()->comment('投票結束時間');
        };
    }
}
