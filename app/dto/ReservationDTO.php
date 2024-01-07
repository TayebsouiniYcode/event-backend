<?php

namespace App\dto;

use App\Models\Ticket;
use App\Models\User;

class ReservationDTO
{
    public $id;
    public $ticket_id;
    public $user_id;
    public $quantity;
    public $price;
    public $reservation_date;
    public $paid;
    public Ticket $ticket;
    public User $user;

    public function __construct($id, $ticket_id, $user_id, $quantity, $price, $reservation_date, $paid)
    {
        $this->id = $id;
        $this->ticket_id = $ticket_id;
        $this->user_id = $user_id;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->reservation_date = $reservation_date;
        $this->paid = $paid;
    }

    public function addTicket($ticket) {
        $this->ticket = $ticket;
    }

    public function addUser($user) {
        $this->user = $user;
    }
}
