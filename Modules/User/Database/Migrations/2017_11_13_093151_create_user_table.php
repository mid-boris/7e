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
            $table->string('nick_name', 16)->nullable()->comment('暱稱');

            $table->unsignedTinyInteger('status')->default(1)->comment('狀態');

            $table->string('mail')->nullable()->comment('信箱');
            $table->string('phone')->nullable()->comment('手機');
            $table->unsignedInteger('area_id')->nullable();
            $table->unsignedTinyInteger('gender')->nullable()->comment('性別, 0:男、1:女');

            $table->timestamps();

            $table->unique('account');
            $table->index(['account', 'password']);
            $table->index(['account', 'password', 'status']);
            $table->index('status');
        };
    }
}
