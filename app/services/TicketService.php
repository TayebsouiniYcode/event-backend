<?php

namespace App\Services;

use App\Models\Ticket;

class TicketService {

    public function __construct() {}

    public function getTicketsByEventId($id) {
        $tickets = Ticket::where('event_id', $id)->get();

        return $tickets;
    }
}
