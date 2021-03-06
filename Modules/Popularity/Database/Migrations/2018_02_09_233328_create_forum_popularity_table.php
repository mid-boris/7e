<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateForumPopularityTable extends BaseMigration
{
    protected $table = 'forum_popularity';

    protected $tableComment = '紀錄每個討論版的每日人氣 (重複)';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('forum_id');
            $table->unsignedInteger('day');
            $table->unsignedInteger('accumulation_popularity')->comment('累積人氣, 會重複計數');

            $table->timestamps();

            $table->unique(['forum_id', 'day'], 'idx_forum_id_day');
            $table->index('forum_id', 'idx_forum_id');
            $table->index('day', 'idx_day');

            $table->foreign('forum_id')
                ->references('id')->on('forum')
                ->onDelete('cascade');
        };
    }
}
