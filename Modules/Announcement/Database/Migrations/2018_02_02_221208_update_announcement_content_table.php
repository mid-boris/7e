<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class UpdateAnnouncementContentTable extends BaseMigration
{
    protected $table = 'announcement_content';

    protected $tableComment = '新增複合索引 確保每筆下只會有一個語系';

    protected $mode = 'update';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->unique(['announcement_id', 'language'], 'idx_announcement_id_language');
        };
    }
}
