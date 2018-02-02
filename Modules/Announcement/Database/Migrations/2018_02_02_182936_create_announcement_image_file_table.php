<?php
use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateAnnouncementImageFileTable extends BaseMigration
{
    protected $table = 'announcement_image_file';

    protected $tableComment = '公告的圖片關聯表';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('announcement_id');
            $table->unsignedInteger('image_id');

            $table->index('announcement_id', 'idx_announcement_id');
            $table->index('image_id', 'idx_image_id');

            $table->foreign('announcement_id')
                ->references('id')->on('announcement')
                ->onDelete('cascade');
        };
    }
}
