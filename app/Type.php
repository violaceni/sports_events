<?php

namespace App;

use App\Match;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function match()
    {
        return $this->belongsTo(Match::class);
    }
}
