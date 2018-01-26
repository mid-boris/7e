<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class CreateGoogleAreaTable extends BaseMigration
{
    protected $table = 'google_area';

    protected $tableComment = '儲存由google map回饋的地區資訊';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('shop_id');
            
            $table->string('name', 128)->nullable();

            $table->timestamps();

            $table->index('shop_id', 'idx_shop_id');
            $table->index('name', 'idx_name');
        };
    }
}
