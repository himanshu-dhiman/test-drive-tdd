<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Event;

class BuyTicketsTest extends TestCase
{
    /** @test */

    public function can_buy_tickets()
    {

    	//Arrange
    	//Create a Event

    	$event = factory(Event::class)->create([
    		'ticket_price' => 500
    	]);

    	//Act
    	//View a Event Listing
    	$response = $this->json('POST', "/event/{$event->id}/tickets", [
			    		'email' => 'himanshu@betalectic.com',
			    		'ticket_quantity' => 12
			    	]);


		//Assert
    	//Check charged amount is correct
    	$response->assertStatus(200);

    	$order = json_decode($response->content())->orderDetails;

    	$this->assertEquals(6000, $order->total_price);
    	$this->assertEquals('himanshu@betalectic.com', $order->email);
    	$this->assertEquals(12, $order->ticket_quantity);	

    }


    /** @test */

    public function email_is_required()
    {
		//Arrange
		$event = factory(Event::class)->create();
    	
		//Act
    	$response = $this->json('POST', "/event/{$event->id}/tickets", [
			    		'ticket_quantity' => 12
			    	]);

    	//Assert
		$response->assertStatus(422);
		$this->assertArrayHasKey('email', $response->decodeResponseJson()['errors']);
    } 
}
