<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateAnnouncementContentTable extends BaseMigration
{
    protected $table = 'announcement_content';

    protected $tableComment = '公告的內容 by 語系分';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('announcement_id');

            $table->string('language', 16)->comment('語系');
            $table->string('title')->comment('標題');
            $table->text('content')->comment('內文');

            $table->timestamps();

            $table->index('language', 'idx_language');
        };
    }
}
