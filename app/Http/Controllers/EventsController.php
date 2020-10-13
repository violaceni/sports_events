<?php

namespace App\Http\Controllers;


use Calendar;
use App\Event;
use App\Status;
use App\Category;
use App\Match;
use App\CalendarEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EventsController extends Controller
{
    public function calendar()
    {
        $statuses = Status::all();
        $categories = Category::all();
        return view('fullcalendar')->with([
            'statuses' => $statuses,
            'categories' => $categories,
        ]);
    }

    public function getEvents()
    {

        $calendar_events = Event::select('name as title', 'start_date as start', 'end_date as end')->get();
        return response()->json($calendar_events, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Event::validate($request);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $event = Event::create($data);
        }
        return redirect('/events/index')->with(['message' => "New Event Added"]);
    }

    public function index()
    {
        return view('events.index');
    }

    public function fetchAll()
    {
        $events = Event::with('category')->get();
        return datatables()->of($events)->toJson();
    }

    public function getDetails(Request $request, $id)
    {

        $event = Event::find($id);
        $statuses = Status::all();
        $categories = Category::all();

        return view('events.details')->with([
            'event' => $event,
            'statuses' => $statuses,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Event::validate($request);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $event = Event::find($id);
            $event->fill($request->all());
            $event->save();
            return redirect('/events/index')->with(['message' => "Event updated"]);
        }
    }

    public function delete(Request $request, $id)
    {
        $event = Event::find($id);
        $event->matches()->delete();
        $event->delete();
    }
}
