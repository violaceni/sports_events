<?php

namespace App;

use App\Event;
use App\Location;
use App\Team;
use App\Type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Match extends Model
{
    protected $table = 'matches';
    protected $primaryKey = 'id';
    protected $fillable = ['start_time', 'end_time', 'first_team_id', 'second_team_id', 'location_id', 'event_id', 'type_id'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function type()
    {
        return $this->hasOne(Type::class);
    }

    public static function validate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_team_id' => 'required',
            'second_team_id' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after_or_equal:start_time',
            'event_id' => 'required',
            'location_id' => 'required',
            'type_id' => 'required',
        ]);

        return $validator;
    }
}
