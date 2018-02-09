<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateUserSurpriseItemTable extends BaseMigration
{
    protected $table = 'user_surprise_item';

    protected $tableComment = '會員與驚喜箱連結';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('surprise_item_id');

            $table->timestamps();
            
            $table->index('user_id', 'idx_user_id');
            $table->index('surprise_item_id', 'idx_surprise_item_id');
            $table->unique(['user_id', 'created_at'], 'user_id_created');
        };
    }
}
