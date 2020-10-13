<?php

namespace App\Http\Controllers;

use DB;
use App\Team;
use App\Type;
use DateTime;
use App\Event;
use App\Match;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MatchesController extends Controller
{
    public function index()
    {
        return view('matches.index');
    }

    public function fetchAll()
    {
        $matches = DB::table('matches')
            ->join('teams as  team1', 'matches.first_team_id', '=', 'team1.id')
            ->join('teams as  team2', 'matches.second_team_id', '=', 'team2.id')
            ->join('events', 'matches.event_id', '=', 'events.id')
            ->join('locations', 'matches.location_id', '=', 'locations.id')
            ->select('events.name as event', 'locations.venue as venue', 'matches.start_time', 'matches.end_time', 'team1.name as first_team', 'team2.name as second_team')
            ->get();
        return datatables()->of($matches)->toJson();
    }

    public function create()
    {
        $teams = Team::all();
        $locations = Location::all();
        $types = Type::all();
        $events = Event::all();

        return view('matches.create')->with([
            'teams' => $teams,
            'locations' => $locations,
            'types' => $types,
            'events' => $events
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['start_time'] = new DateTime($request->start_time);
        $datetime['end_time'] = new DateTime($request->end_time);
        $validator = Match::validate($request);
        if ($validator->fails()) { 
            return Redirect::back()->withErrors($validator)->withInput();
        } else { 
            $match = Match::create($data);
        }
        return redirect('/matches/index')->with(['message' => "New Match Added"]);
    }
}
