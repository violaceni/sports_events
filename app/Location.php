<?php

namespace App;

use App\Match;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $primaryKey = 'id';
    protected $fillable = ['country', 'city', 'venue'];

    public function matches()
    {
        return $this->hasMany(Match::class, 'location_id_fk');
    }
}
