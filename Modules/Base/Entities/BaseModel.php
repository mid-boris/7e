<?php

namespace Modules\Base\Entities;

use DB;
use Illuminate\Database\Eloquent\Model;
use Modules\Base\Constants\ConnectionConfigConstants;

/**
 * Class BaseModel
 * @package Modules\Base\Entities
 */
abstract class BaseModel extends Model
{
    protected $connection = ConnectionConfigConstants::MAIN_CONNECTION_NAME;

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function getExistsParent(string $column, string $value, string $key = 'id', string $parentKey = 'parent_id')
    {
        $valueCollect = explode('.', $value);
        if (count($valueCollect) > 1) {
            /** @var \Illuminate\Database\Eloquent\Builder|null $parent */
            $parent = null;
            foreach ($valueCollect as $serial => $name) {
                /** @var \Illuminate\Database\Eloquent\Builder $model */
                $model = new $this;
                $asTable = $model->getTable() . $serial;
                $model = $model->select(DB::raw("{$asTable}.{$key}"))
                    ->from(DB::raw("{$model->getTable()} AS {$asTable}"))
                    ->where("{$asTable}.{$column}", $name);
                if (!is_null($parent)) {
                    $parent = $parent->whereRaw("{$parent->asTable}.{$key} = {$asTable}.{$parentKey}");
                    $model = $model->whereRaw("exists ({$parent->toSql()})")
                        ->addBinding($parent->getBindings());
                }
                $parent = $model;
                $parent->asTable = $asTable;
            }
            $result = $parent->select()->first();
            return $result;
        } else {
            /** @var \Illuminate\Database\Eloquent\Builder $this */
            return $this->where($column, $value)->first();
        }
    }

    public function like($column, string $compared)
    {
        /** @var \Eloquent $this */
        return $this->where($column, 'like', "%{$compared}%");
    }

    /**
     * @param string $sort
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|Model
     */
    public function orderNew(string $sort = 'DESC')
    {
        /** @var \Eloquent $this */
        return $this->orderBy('updated_at', $sort);
    }
}
