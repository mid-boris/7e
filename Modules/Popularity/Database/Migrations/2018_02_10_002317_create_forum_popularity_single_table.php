<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateForumPopularitySingleTable extends BaseMigration
{
    protected $table = 'forum_popularity_single';

    protected $tableComment = '討論版人氣 (不重複)';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('forum_id');
            $table->unsignedInteger('day');

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('area_id')->nullable();
            $table->unsignedTinyInteger('gender')->nullable();

            $table->timestamps();

            $table->unique(['forum_id', 'day', 'user_id'], 'idx_forum_id_day_user_id');
            $table->index('forum_id', 'idx_forum_id');
            $table->index('day', 'idx_day');
            $table->index('user_id', 'idx_user_id');
            $table->index('area_id', 'idx_area_id');
            $table->index('gender', 'idx_gender');
        };
    }
}
