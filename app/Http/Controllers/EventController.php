<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Order;

class EventController extends Controller
{
    public function show($id) 
    {
    	$events = Event::find($id);
    	return view('events.show', ['event' => $events]);
    }

    public function buyTicket($eventId, Request $request)
    {
    	$concert = Event::find($eventId);

    	$this->validate($request, [
    		'email' => 'required'
    	]);

        $ticketQuantity = $request->get('ticket_quantity');
        $amountCharged = $concert->ticket_price * $ticketQuantity;
        $email = $request->get('email');

        $order = Order::create([
        	'event_id' => $eventId,
        	'email' => $email,
        	'ticket_quantity' => $ticketQuantity,
        	'total_price' => $amountCharged,
        ]);

        return response()->json([
        	'orderDetails' => $order
        ], 200);
    }
}
