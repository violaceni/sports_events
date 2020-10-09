<?php

namespace App;

use App\Match;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function match()
    {
        return $this->hasMany(Match::class);
    }
}
