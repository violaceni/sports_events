<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'satus_id_fk');
    }

}
