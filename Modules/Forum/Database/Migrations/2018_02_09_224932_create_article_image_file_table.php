<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class CreateArticleImageFileTable extends BaseMigration
{
    protected $table = 'article_image_file';

    protected $tableComment = '文章附帶圖片';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('article_id');
            $table->unsignedInteger('image_id');

            $table->index('article_id', 'idx_article_id');
            $table->index('image_id', 'idx_image_id');

            $table->foreign('article_id')
                ->references('id')->on('article')
                ->onDelete('cascade');
        };
    }
}
