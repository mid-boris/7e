<?php

namespace Modules\Base\Contract\Database;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Modules\Base\Constants\ConnectionConfigConstants;
use Modules\Base\Exception\BaseException;
use Modules\Error\Constants\ErrorCode;

abstract class BaseMigration extends Migration
{
    const MODE_CREATE = 'create';

    const MODE_UPDATE = 'update';

    /** @var string  */
    protected $table = '';

    /** @var string  */
    protected $tableComment = '';

    /** @var string  */
    protected $connection = ConnectionConfigConstants::MAIN_CONNECTION_NAME;

    /** @var  string */
    protected $mode = 'create';

    public function up()
    {
        Schema::connection($this->getConnection())->{$this->getModeFunc()}($this->table, $this->tableSchema());
        if ($this->mode == self::MODE_CREATE) {
            \DB::connection($this->getConnection())
                ->statement("ALTER TABLE `{$this->table}` comment '{$this->tableComment}'");
        }
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
        if ($this->mode == self::MODE_CREATE) {
            \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 0');
            Schema::connection($this->getConnection())->dropIfExists($this->table);
            \DB::connection($this->getConnection())->statement('SET FOREIGN_KEY_CHECKS = 1');
        }
    }

    private function getModeFunc()
    {
        switch ($this->mode) {
            case self::MODE_CREATE:
                return 'create';
            case self::MODE_UPDATE:
                return 'table';
            default:
                throw new BaseException(
                    'base migrate mode error',
                    ErrorCode::BASE_MIGRATE_MODE_ERROR
                );
        }
    }
}
