<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class UpdateMenuTable extends BaseMigration
{
    protected $table = 'menu';

    protected $mode = 'update';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->unsignedTinyInteger('height_light')->default(0)->comment('置頂');
            $table->unsignedTinyInteger('hot')->default(0)->comment('熱門');
        };
    }
}
