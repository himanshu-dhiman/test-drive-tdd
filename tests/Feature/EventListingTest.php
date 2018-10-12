<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use App\Event;

class EventListingTest extends TestCase
{
    /** @test */

    public function register_and_list_event()
    {
    	//Arrange
    	//Create a Event

    	$event = Event::firstOrCreate([
    		'name' => "Some Event",
    		'venue' => "Manikonda, Hyderabad",
    		'date' => Carbon::parse('2018-06-24'),
            'ticket_price' => 400
    	]);

    	//Act
    	//View a Event Listing
    	$response = $this->get("/event/".$event->id);
    	

    	//Assert
    	//See the Event Listing
    	$response->assertStatus(200);

    	$response->assertSee('Some Event');
    	$response->assertSee('Manikonda, Hyderabad');
    	$response->assertSee('June 24, 2018');

    }
}
