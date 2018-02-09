<?php
namespace Modules\Reservation\Entities;

use Modules\Shop\Entities\Shop;

class Reservation extends ReservationBaseModel
{
    protected $table = 'reservation';

    protected $fillable = [
        'shop_id', 'account_id', 'account', 'nick_name', 'phone', 'reservation_time', 'number_of_people', 'applied',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
