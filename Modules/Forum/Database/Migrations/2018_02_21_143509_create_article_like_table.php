<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateArticleLikeTable extends BaseMigration
{
    protected $table = 'article_like';

    protected $tableComment = '紀錄like bad數';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('article_id');
            $table->unsignedInteger('user_id');
            $table->unsignedTinyInteger('like_type')->comment('參照 ArticleLikeTypeConstants');
            
            $table->index('article_id', 'idx_article_id');
            $table->index('user_id', 'idx_user_id');
            $table->unique(['article_id', 'user_id'], 'article_user_id');
            $table->unique(['article_id', 'user_id', 'like_type'], 'article_user_id_like_type');
        };
    }
}
