<?php
namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Api\Http\Requests\ReservationSend;
use Modules\Base\Utilities\Response\BaseResponse;
use Modules\Reservation\Repositories\ReservationRepository;

class ReservationController extends Controller
{
    public function index()
    {
        /** @var ReservationRepository $reservationRepo */
        $reservationRepo = app()->make(ReservationRepository::class);
        return BaseResponse::response(['data' => $reservationRepo->getPaginationUseUserId()]);
    }
    
    public function send(ReservationSend $request)
    {
        /** @var ReservationRepository $reservationRepo */
        $reservationRepo = app()->make(ReservationRepository::class);
        $reservationRepo->create($request->all());
        return BaseResponse::response(['data' => true]);
    }
}
