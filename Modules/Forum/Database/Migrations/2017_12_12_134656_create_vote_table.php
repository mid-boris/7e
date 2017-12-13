<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class CreateVoteTable extends BaseMigration
{
    protected $table = 'vote';

    protected $tableComment = '投票item';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('article_id');
            $table->string('option_name', 32);
            $table->unsignedInteger('vote_count')->default(0)->comment('票數');

            $table->timestamps();
        };
    }
}
