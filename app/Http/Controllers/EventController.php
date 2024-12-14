<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'event_date' => 'required|date',
            'description' => 'required',

        ]);
        Event::create($request->all());
        return redirect()->route('events.index')->with('success', 'Event added successfully!');
    }
    public function create()
    {
        return view('events.create');
    }
    public function index()
    {
        $events = Event::paginate(10); // Paginare
        return view('events.index', compact('events'));
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
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }

}
