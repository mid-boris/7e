<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateSurpriseItemTable extends BaseMigration
{
    protected $table = 'surprise_item';

    protected $tableComment = '每箱的內容物';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('surprise_box_id');

            $table->string('name', 32);
            $table->string('description');

            $table->unsignedInteger('expiration')->nullable();

            $table->timestamps();

            $table->index('surprise_box_id', 'idx_surprise_box_id');
        };
    }
}
