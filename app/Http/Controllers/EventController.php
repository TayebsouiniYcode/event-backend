<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function create(Request $request)
    {
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
        
        try {
            $event->save();
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
        $event->name = $request->name;
        $event->description = $request->description;
        $event->start_date = $request->start_date;
        $event->start_time = $request->start_time;
        $event->end_date = $request->end_date;
        $event->end_time = $request->end_time;
        $event->address_id = $request->address_id;
        $event->image = $request->image;
        $event->proprietor_id = $request->proprietor_id;
        $event->save();
        return response()->json([
            'message' => 'Event updated successfully',
            'event' => $event
        ], 200);
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
        return response()->json([
            'event' => $event
        ], 200);
    }
}
