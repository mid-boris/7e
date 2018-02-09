<?php
namespace Modules\Template\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Reservation\Repositories\ReservationRepository;
use Modules\Template\Http\Requests\ReservationApplied;
use Modules\Template\Http\Requests\ReservationDelete;

class ReservationController extends Controller
{
    public function applied(ReservationApplied $request)
    {
        /** @var ReservationRepository $reservationRepo */
        $reservationRepo = app()->make(ReservationRepository::class);
        $reservationRepo->applied($request->input('id'));
        return redirect()->back();
    }
    
    public function delete(ReservationDelete $request)
    {
        /** @var ReservationRepository $reservationRepo */
        $reservationRepo = app()->make(ReservationRepository::class);
        $reservationRepo->delete($request->input('id'));
        return redirect()->back();
    }
}
