<?php
namespace Modules\Announcement\Repositories;

use Modules\Announcement\Entities\Announcement;

class AnnouncementRepository
{
    public function getPagination($status = null, $type = null, $startTime = null, $endTime = null)
    {
        $announcement = new Announcement;
        if (!is_null($status)) {
            $announcement = $announcement->where('status', $status);
        }
        if (!is_null($type)) {
            $announcement = $announcement->where('type', $type);
        }
        if (!is_null($startTime)) {
            $announcement = $announcement->where('start_time', '<=', $startTime);
        }
        if (!is_null($status)) {
            $announcement = $announcement->where('end_time', '>=', $endTime);
        }
        $results = $announcement->with(['content', 'images', 'shop'])
            ->orderByDesc('high_light')->orderByDesc('created_at')->paginate(35);
        return $results;
    }

    public function getPaginationTimeFilter($language = null, $type = null)
    {
        $announcement = new Announcement;
        if (!is_null($type)) {
            $announcement = $announcement->where('type', $type);
        }
        $announcement = $announcement->where(function ($sub) {
            /** @var \Illuminate\Database\Eloquent\Builder $sub */
            $sub->where(function ($query) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->whereNull('start_time')->whereNull('end_time');
            })->orWhere(function ($query) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->where('start_time', '<=', time())->whereNull('end_time');
            })->orWhere(function ($query) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->whereNull('start_time')->where('end_time', '>=', time());
            })->orWhere(function ($query) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->where('start_time', '<=', time())->where('end_time', '>=', time());
            });
        })->where('status', 1);
        $results = $announcement->whereHas('content', function ($query) use ($language) {
            /** @var \Illuminate\Database\Eloquent\Builder $query */
            $query->where('language', $language);
        })->with(['content' => function ($query) use ($language) {
            /** @var \Illuminate\Database\Eloquent\Builder $query */
            $query->where('language', $language);
        }, 'images', 'shopReferStatus'])->orderByDesc('high_light')->orderByDesc('created_at')->paginate(35);
        return $results;
    }
}
