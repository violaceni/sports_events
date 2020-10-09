<?php

namespace App;

use App\Match;
use App\Status;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'start_date', 'end_date', 'description', 'status_id_fk', 'category_id_fk'];

    public function status()
    {
        return $this->hasOne(Status::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function matches()
    {
        return $this->hasMany(Match::class, 'event_id_fk');
    }
}
