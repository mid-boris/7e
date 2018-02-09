<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateReservationTable extends BaseMigration
{
    protected $table = 'reservation';

    protected $tableComment = '線上預訂管理';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('shop_id');

            $table->unsignedInteger('account_id');
            $table->string('account', 32)->comment('帳號');

            $table->string('nick_name', 16)->comment('暱稱');
            $table->string('phone', 32)->comment('手機');
            $table->unsignedInteger('reservation_time');
            $table->unsignedInteger('number_of_people');

            $table->unsignedTinyInteger('applied')->default(0);

            $table->timestamps();

            $table->index('account_id', 'idx_account_id');
            $table->index('shop_id', 'idx_shop_id');
            $table->index('account', 'idx_account');
            $table->index('phone', 'idx_phone');
        };
    }
}
