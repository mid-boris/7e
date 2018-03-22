<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class UpdateArticleTable extends BaseMigration
{
    protected $table = 'article';

    protected $tableComment = '新增大頭貼欄位';

    protected $mode = 'update';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->mediumText('avatar')->nullable()->comment('大頭像');
        };
    }
}
