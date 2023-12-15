<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function create(Request $request)
    {
        try {
            $ticket = new Ticket();
            $ticket->name = $request->name;
            $ticket->description = $request->description;
            $ticket->price = $request->price;
            $ticket->quantity = $request->quantity;
            $ticket->event_id = $request->event_id;
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ticket creation failed: ' . $e->getMessage()
            ], 409);
        }

        try {
            $ticket->save();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ticket creation failed: ' . $e->getMessage()
            ], 409);
        }

        return response()->json([
            'message' => 'Ticket created successfully'
        ], 201);
    }

    public function update(Request $request)
    {
        $ticket = Ticket::find($request->id);

        if (!$ticket) {
            return response()->json([
                'message' => 'Ticket not found'
            ], 404);
        }

        if (isset($request->name)){
            $ticket->name = $request->name;
        }

        if (isset($request->description)){
            $ticket->description = $request->description;
        }

        if (isset($request->price)){
            $ticket->price = $request->price;
        }

        if (isset($request->quantity)){
            $ticket->quantity = $request->quantity;
        }

        if (isset($request->event_id)){
            $ticket->event_id = $request->event_id;
        }

        try {
            $ticket->save();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ticket update failed: ' . $e->getMessage()
            ], 409);
        }

        return response()->json([
            'message' => 'Ticket updated successfully'
        ], 200);
    }

    public function delete(Request $request)
    {
        $ticket = Ticket::find($request->id);

        if (!$ticket) {
            return response()->json([
                'message' => 'Ticket not found'
            ], 404);
        }

        try {
            $ticket->delete();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ticket deletion failed: ' . $e->getMessage()
            ], 409);
        }

        return response()->json([
            'message' => 'Ticket deleted successfully'
        ], 200);
    }

    public function getTicketsByEventId(Request $request)
    {
        $tickets = Ticket::where('event_id', $request->id)->get();

        return response()->json([
            'tickets' => $tickets
        ], 200);
    }

    public function getTicketById(Request $request)
    {
        $ticket = Ticket::find($request->id);

        if (!$ticket) {
            return response()->json([
                'message' => 'Ticket not found'
            ], 404);
        }

        return response()->json([
            'ticket' => $ticket
        ], 200);
    }
}
