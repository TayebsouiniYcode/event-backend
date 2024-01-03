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
        $reservation->user_id = $request->user_id ?? 1;
        $reservation->quantity = $request->quantity ?? 1;
        $reservation->reservation_date = date("Y-m-d H:i:s");
        $reservation->paid = false;

        $reservationService = new ReservationService();
        $reservation = $reservationService->checkout($reservation);

        return $reservation;
    }

    public function reservationMultiple(Request $request)
    {

    }
}
