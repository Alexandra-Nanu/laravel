<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(Request $request)
    {
        //store method to handle the creation of a new event
        $request->validate([
            //validate incoming request data for required fields
            'name' => 'required',
            'event_date' => 'required|date',
            'description' => 'required',

        ]);
        Event::create($request->all()); //create a new event record in the database using the validated request data
        return redirect()->route('events.index')->with('success', 'Event added successfully!'); //redirect user to the event index page with a success message
    }
    public function create()
    {
        //create method to display the form for creating a new event
        return view('events.create'); //return the view for creating an event
    }
    public function index()
    {
        //index method to display a list of events
        $events = Event::paginate(10); //paginated list of events, with 10 events per page
        return view('events.index', compact('events')); //return the index view, passing the events data to it
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id); //find the event by its ID or fail if not found
        return view('events.edit', compact('event')); //return the edit view, passing the event data to it
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'event_date' => 'required|date',
            'description' => 'required',
        ]);
        $event = Event::findOrFail($id);
        $event->update($request->all());
        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }
    public function destroy($id)
    {
        //method used to handle deletion of event
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }

}
