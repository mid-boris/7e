<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Base\Contract\Database\BaseMigration;

class CreateArticleTable extends BaseMigration
{
    protected $table = 'article';

    protected $tableComment = '討論區內文, 文章';

    protected function tableSchema(): \Closure
    {
        return function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedTinyInteger('forum_id')->comment('討論版id');
            $table->unsignedTinyInteger('parent_id')->nullable()->comment('父文章');
            $table->string('title')->comment('標題');
            $table->text('context')->comment('內文');
            $table->unsignedTinyInteger('audit')->default(0)->comment('當為1時, 代表該篇文需要審核');

            $table->unsignedInteger('user_id')->comment('使用者id');
            $table->string('user_account', 32);
            $table->string('user_nick_name', 16);

            $table->unsignedInteger('audit_user_id')->nullable()->comment('審核者id');
            $table->string('audit_user_account', 32)->nullable();
            $table->string('audit_user_nick_name', 16)->nullable();

            $table->timestamps();

            $table->index('forum_id');
            $table->index('parent_id');
            $table->index('audit');
            $table->index('user_id');
            $table->index('user_account');
        };
    }
}
