<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Event;
use App\Models\Ticket;
use App\dto\EventDTO;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public $eventDTO;

    public function create(Request $request)
    {
        return "test";
        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->start_date = $request->start_date;
        $event->start_time = $request->start_time;
        $event->end_date = $request->end_date;
        $event->end_time = $request->end_time;
        $event->image = $request->image;
        $event->proprietor_id = $request->proprietor_id;

        $address = new Address();
        $address->address = $request->address['address'];
        $address->city = $request->address['city'];
        $address->country = $request->address['country'];
        $address->zip_code = $request->address['zip_code'];

        try {
            $address->save();
            $event->address_id = $address->id;
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Address creation failed: ' . $e->getMessage()
            ], 409);
        }

        $tickets = $request->tickets;

        try {
            $event->save();

            foreach ($tickets as $ticket) {
                $newTicket = new Ticket();
                $newTicket->name = $ticket['name'];
                $newTicket->description = $ticket['description'];
                $newTicket->price = $ticket['price'];
                $newTicket->quantity = $ticket['quantity'];
                $newTicket->event_id = $event->id;

                try {
                    $newTicket->save();
                } catch (\Exception $e) {
                    return response()->json([
                        'message' => 'Ticket creation failed: ' . $e->getMessage()
                    ], 409);
                }
            }


            return response()->json([
                'message' => 'Event created successfully',
                'event' => $event
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Event creation failed: ' . $e->getMessage()
            ], 409);
        }
    }

    public function update(Request $request)
    {
        $event = Event::find($request->id);

        if (!$event) {
            return response()->json([
                'message' => 'Event not found'
            ], 404);
        }

        if (isset($request->name)){
            $event->name = $request->name;
        }

        if (isset($request->description)){
            $event->description = $request->description;
        }

        if (isset($request->start_date)){
            $event->start_date = $request->start_date;
        }

        if (isset($request->start_time)){
            $event->start_time = $request->start_time;
        }

        if (isset($request->end_date)){
            $event->end_date = $request->end_date;
        }

        if (isset($request->end_time)){
            $event->end_time = $request->end_time;
        }

        if (isset($request->address_id)){
            $event->address_id = $request->address_id;
        }

        if (isset($request->image)){
            $event->image = $request->image;
        }

        if (isset($request->proprietor_id)){
            $event->proprietor_id = $request->proprietor_id;
        }

        try {
            $event->save();

            return response()->json([
                'message' => 'Event updated successfully',
                'event' => $event
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Event update failed: ' . $e->getMessage()
            ], 409);
        }
    }

    public function delete(Request $request)
    {
        $event = Event::find($request->id);
        $event->delete();
        return response()->json([
            'message' => 'Event deleted successfully'
        ], 200);
    }

    public function getAll()
    {
        $events = Event::all();
        return response()->json([
            'events' => $events
        ], 200);
    }

    public function getByProprietor(Request $request)
    {
        $events = Event::where('proprietor_id', $request->proprietor_id)->get();
        return response()->json([
            'events' => $events
        ], 200);
    }

    public function getByAddress(Request $request)
    {
        $events = Event::where('address_id', $request->address_id)->get();
        return response()->json([
            'events' => $events
        ], 200);
    }

    public function getByDate(Request $request)
    {
        $events = Event::where('start_date', $request->start_date)->get();
        return response()->json([
            'events' => $events
        ], 200);
    }

    public function getByName(Request $request)
    {
        $events = Event::where('name', $request->name)->get();
        return response()->json([
            'events' => $events
        ], 200);
    }

    public function getById(Request $request)
    {
        $event = Event::find($request->id);

        if ($event == null) {
            return response()->json([
                'message' => 'Event not found'
            ], 404);
        }


        $this->eventDTO = new EventDTO($event->id, $event->name, $event->description,
            $event->start_date, $event->start_time, $event->end_date,
            $event->end_time,  $event->address_id,$event->image, $event->proprietor_id);

        return response()->json([
            'event' => $this->eventDTO
        ], 200);
    }
}
