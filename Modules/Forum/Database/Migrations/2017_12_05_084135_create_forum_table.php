<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class CreateForumTable extends BaseMigration
{
    protected $table = 'forum';

    protected $tableComment = '討論版';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('parent_id')->nullable();
            $table->string('name');
            $table->unsignedTinyInteger('audit')->comment('該版發文是否需要審核');
            $table->unsignedTinyInteger('status')->comment('狀態, 1: 啟用');
            $table->unsignedInteger('sort')->default(0);

            $table->timestamps();

            $table->index('audit');
            $table->index('status');
        };
    }
}
