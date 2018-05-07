<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class CreateShopTable extends BaseMigration
{
    protected $table = 'shop';

    protected $tableComment = '商家資訊';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 128);
            $table->double('x')->nullable();
            $table->double('y')->nullable();
            $table->string('telphone', 32)->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('address')->nullable();
            $table->string('business_hours')->nullable();
            $table->string('business_hours_start_time', 64)->nullable();
            $table->string('business_hours_end_time', 64)->nullable();
            $table->text('closed_day')->nullable();

            $table->unsignedTinyInteger('special')->default(0);
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedTinyInteger('i_pass')->default(0);

            $table->unsignedInteger('area_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('name');
            $table->index(['x', 'y']);
            $table->index('telphone');
            $table->index('phone');
            $table->index('special');
            $table->index('status');
        };
    }
}
