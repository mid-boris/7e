<?php
namespace Modules\Reservation\Repositories;

use Modules\Entrust\Utilities\SessionManager;
use Modules\Reservation\Entities\Reservation;

class ReservationRepository
{
    /**
     * 後臺用
     * @param int $perpage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPagination(int $perpage = 35)
    {
        /** @var \Eloquent $reservation */
        $reservation = new Reservation;
        return $reservation->with(['shop'])
            ->orderByDesc('id')
            ->paginate($perpage);
    }

    /**
     * 會員端用 | 後臺用(?)
     * @param int $perpage
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPaginationUseUserId(int $perpage = 35)
    {
        /** @var \Eloquent $reservation */
        $reservation = new Reservation;
        return $reservation->with(['shop', 'shop.trademark'])
            ->where('account_id', SessionManager::getUserId())
            ->orderByDesc('id')
            ->get();
    }

    public function create(array $data)
    {
        $data['account_id'] = SessionManager::getUserId();
        $data['account'] = SessionManager::getUserAccount();
        /** @var \Eloquent $reservation */
        $reservation = new Reservation;
        return $reservation->fill($data)->save();
    }

    public function applied(int $id)
    {
        return $this->update([
            'applied' => 1,
        ], $id);
    }

    public function update(array $data, int $id)
    {
        return Reservation::where('id', $id)->update($data);
    }

    public function delete(int $id)
    {
        return Reservation::where('id', $id)->delete();
    }
}
