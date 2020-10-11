<?php

namespace App;

use App\Event;
use App\Location;
use App\Team;
use App\Type;
use Illuminate\Database\Eloquent\Model;

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
}
