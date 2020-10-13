<?php

namespace App\Http\Controllers;

use App\Location;

class LocationsController extends Controller
{
    public function index()
    {
        return view('locations.index');
    }

    public function fetchAll()
    {
        $locations = Location::all();
        return datatables()->of($locations)->toJson();
    }
}
