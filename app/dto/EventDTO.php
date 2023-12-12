<?php

namespace App\dto;

use App\dto\AddressDTO;
use App\Services\TicketService;

class EventDTO {
    public $id;
    public $name;
    public $description;
    public $start_date;
    public $start_time;
    public $end_date;
    public $end_time;
    public $address_id;
    public $image;
    public $proprietor_id;
    public $address;
    public $tickets = [];
    public $proprietor;



    public function __construct($id, $name, $description, $start_date, $start_time, $end_date,
                                $end_time, $address_id, $image, $proprietor_id
                                )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->start_date = $start_date;
        $this->start_time = $start_time;
        $this->end_date = $end_date;
        $this->end_time = $end_time;
        $this->address_id = $address_id;
        $this->image = $image;
        $this->proprietor_id = $proprietor_id;

        $this->address = new AddressDTO($this->address_id);

        $ticketService = new TicketService();
        $this->tickets = $ticketService->getTicketsByEventId($this->id);
    }
}
