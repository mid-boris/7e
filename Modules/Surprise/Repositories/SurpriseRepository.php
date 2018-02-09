<?php
namespace Modules\Surprise\Repositories;

use Modules\Surprise\Entities\SurpriseBox;

class SurpriseRepository
{
    public function get(int $id)
    {
        return SurpriseBox::find($id);
    }
    
    public function getPagination()
    {
        /** @var \Eloquent $surpriseBox */
        $surpriseBox = new SurpriseBox;
        return $surpriseBox->orderByDesc('id')->paginate(35);
    }

    public function create(array $data)
    {
        $this->startTimeProcess($data);
        $this->endTimeProcess($data);
        /** @var \Eloquent $model */
        $model = new SurpriseBox;
        return $model->fill($data)->save();
    }

    public function update(array $data, int $id)
    {
        $this->startTimeProcess($data);
        $this->endTimeProcess($data);
        /** @var \Eloquent $model */
        $model = new SurpriseBox;
        return $model->where('id', $id)->update($data);
    }

    public function delete(int $id)
    {
        /** @var \Eloquent $model */
        $model = new SurpriseBox;
        return $model->where('id', $id)->delete();
    }

    private function startTimeProcess(array &$data)
    {
        if (array_key_exists('start_time', $data)) {
            $this->timeProcess($data['start_time']);
        }
    }

    private function endTimeProcess(array &$data)
    {
        if (array_key_exists('start_time', $data)) {
            $this->timeProcess($data['end_time'], 1);
        }
    }

    private function timeProcess(&$time, $plusDay = 0)
    {
        if (!is_null($time)) {
            $time = strtotime($time . "+{$plusDay} days");
        }
    }
}
