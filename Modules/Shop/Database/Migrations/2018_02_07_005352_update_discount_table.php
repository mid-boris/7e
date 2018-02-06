<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class UpdateDiscountTable extends BaseMigration
{
    protected $table = 'discount';

    protected $tableComment = '新增狀態和時間';

    protected $mode = 'update';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->unsignedTinyInteger('status');
            $table->unsignedTinyInteger('start_time')->nullable()->comment('開始時間');
            $table->unsignedTinyInteger('end_time')->nullable()->comment('結束時間');

            $table->index('status');
            $table->index('start_time');
            $table->index('end_time');
        };
    }
}
