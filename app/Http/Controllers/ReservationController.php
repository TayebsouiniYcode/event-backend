<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\services\ReservationService;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function checkout(Request $request)
    {
        $reservation = new Reservation();

        $reservation->ticket_id = $request->ticket_id;
        $reservation->user_id = $request->user_id;
        $reservation->quantity = $request->quantity;
        $reservation->reservation_date = date("Y-m-d H:i:s");
        $reservation->paid = false;

        $reservationService = new ReservationService();
        $reservation = $reservationService->checkout($reservation);

        return $reservation;
    }

    public function reservationMultiple(Request $request)
    {
        foreach ($request as $res) {
            return $res;
        }
    }
}
