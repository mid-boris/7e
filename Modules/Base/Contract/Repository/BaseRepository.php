<?php

namespace Modules\Base\Contract\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Base\Entities\BaseModel;
use Modules\Base\Exception\BaseException;
use Modules\Error\Constants\ErrorCode;

abstract class BaseRepository
{
    /** @var \Illuminate\Database\Eloquent\Builder  */
    protected $model;

    public function __construct()
    {
    }

    /**
     * @param int $id
     * @return Model
     */
    public function getById(int $id)
    {
        return $this->getByIds([$id])->first();
    }

    /**
     * @param array $ids
     * @return Collection
     * @throws BaseException
     */
    public function getByIds(array $ids)
    {
        if (!$this->model instanceof BaseModel) {
            throw new BaseException(
                trans('entrust::errors.' . ErrorCode::BASE_MODEL_NOT_FOUND),
                ErrorCode::BASE_MODEL_NOT_FOUND
            );
        }
        $results = $this->model->whereIn($this->model->getKey(), $ids)->get();
        return $results;
    }
}
