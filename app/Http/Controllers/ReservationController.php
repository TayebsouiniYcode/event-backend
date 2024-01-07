<?php

namespace App\Http\Controllers;

use App\dto\ReservationDTO;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\services\ReservationService;
use App\Models\Reservation;
use Mockery\Exception;

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

    public  function getReservationsByUser(Request $request)
    {
//        $reservationsDTO = [];

        $reservationModel = new Reservation();
        $reservations = $reservationModel->where('user_id', $request->user_id)->get();

        return $reservations;

//        $ticketModel = new Ticket();

//        foreach ($reservations as $reservation) {
//            try {
//                $reservationDTO =  new ReservationDTO(
//                    1,
//                    1,
//                    1,
//                    2,
//                    0,
//                    "Test",
//                    0
//                );
//
//                $ticket = $ticketModel->find($reservation->ticket_id);
//
//                $reservationDTO->addTicket($ticket);
//
//                $reservationsDTO[] = $reservationDTO;
//
//
//            } catch (Exception $exception){
//                return "Erreur : " . $exception->getMessage();
//            }
//        }

//        return $reservationDTO;
    }
}
