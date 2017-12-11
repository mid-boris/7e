<?php

namespace Modules\Base\Contract\Database;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\ConnectionConfigConstants;

abstract class BaseMigration extends Migration
{
    /** @var string  */
    protected $table = '';

    /** @var string  */
    protected $tableComment = '';

    /** @var string  */
    protected $connection = ConnectionConfigConstants::MAIN_CONNECTION_NAME;

    public function up()
    {
        Schema::connection($this->getConnection())->create($this->table, $this->tableSchema());
        \DB::connection($this->getConnection())
            ->statement("ALTER TABLE `{$this->table}` comment '{$this->tableComment}'");
        $this->run();
    }

    abstract protected function tableSchema() : \Closure;

    protected function run()
    {
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::connection($this->getConnection())->dropIfExists($this->table);
        \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
