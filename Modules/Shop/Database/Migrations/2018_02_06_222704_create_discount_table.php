<?php

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Contract\Database\BaseMigration;

class CreateDiscountTable extends BaseMigration
{
    protected $table = 'discount';

    protected $tableComment = '商家的優惠行為';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('shop_id');

            $table->unsignedSmallInteger('type')->commennt('優惠的類型');

            $table->unsignedInteger('menu_id')->nullable();

            $table->string('custom')->nullable();

            $table->unsignedSmallInteger('age')->nullable();     // 年紀折扣

            $table->string('action', 2)->nullable()->comment('對優惠值的操作行為');    // + - x /
            $table->unsignedDecimal('numeric')->nullable()->comment('要優惠的值');

            $table->timestamps();

            $table->index('shop_id');
            $table->index('type');
            $table->index('menu_id');

            $table->foreign('shop_id')
                ->references('id')->on('shop')
                ->onDelete('cascade');
            $table->foreign('menu_id')
                ->references('id')->on('menu')
                ->onDelete('cascade');
        };
    }
}
