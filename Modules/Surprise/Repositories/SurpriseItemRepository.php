<?php
namespace Modules\Surprise\Repositories;

use Modules\Surprise\Entities\SurpriseItem;

class SurpriseItemRepository
{
    public function getPagination(int $id)
    {
        /** @var \Eloquent $surpriseItem */
        $surpriseItem = new SurpriseItem;
        return $surpriseItem->where('surprise_box_id', $id)->orderByDesc('id')->paginate(35);
    }

    public function create(array $data)
    {
        /** @var \Eloquent $model */
        $model = new SurpriseItem;
        return $model->fill($data)->save();
    }

    public function update(array $data, int $id)
    {
        /** @var \Eloquent $model */
        $model = new SurpriseItem;
        return $model->where('id', $id)->update($data);
    }

    public function delete(int $id)
    {
        /** @var \Eloquent $model */
        $model = new SurpriseItem;
        return $model->where('id', $id)->delete();
    }
}
