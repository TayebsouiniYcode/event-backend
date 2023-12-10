<?php

namespace App\services;

use App\Models\Ticket;
use App\Models\User;

class ReservationService
{

    //constructor
    public function __construct()
    {

    }

    public function checkout($reservation){
        $ticket = Ticket::find($reservation->ticket_id);

        if(!$ticket){
            return response()->json([
                'message' => 'Ticket not found'
            ], 404);
        }

        $user = User::find($reservation->user_id);

        if(!$user){
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        if ($ticket->quantity < $reservation->quantity) {
            return response()->json([
                'message' => 'Not enough tickets'
            ], 409);
        }

        try {
            $reservation->save();

            $ticket->quantity = $ticket->quantity - $reservation->quantity;

            $ticket->save();

             return response()->json([
                'message' => 'Reservation created successfully',
                'reservation' => $reservation], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Reservation creation failed: ' . $e->getMessage()
            ], 409);
        }
    }
}
