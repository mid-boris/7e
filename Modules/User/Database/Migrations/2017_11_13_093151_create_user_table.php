<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateUserTable extends BaseMigration
{
    protected $table = 'user';

    protected $tableComment = '使用者帳號';

    /**
     * Run the migrations.
     * @return Closure
     */
    public function tableSchema() : \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->string('account', 32)->comment('帳號');
            $table->string('password', 32)->comment('密碼');
            $table->string('nick_name', 16)->comment('暱稱');

            $table->unsignedTinyInteger('status')->default(1)->comment('狀態');

            $table->timestamps();

            $table->unique('account');
            $table->index(['account', 'password']);
            $table->index(['account', 'password', 'status']);
            $table->index('status');
        };
    }
}
