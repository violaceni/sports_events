<?php

namespace App;

use App\Match;
use App\Status;
use App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'start_date', 'end_date', 'description', 'status_id', 'category_id'];

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
        return $this->hasMany(Match::class, 'event_id');
    }

    public static function validate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category_id' => 'required',
            'status_id' => 'required',
            'description' => 'required|string|max:1000'
        ]);

        return $validator;
    }
}
