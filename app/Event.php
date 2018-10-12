<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "events";
    protected $fillable = [];
    protected $guarded = [];
    protected $dates = ['date'];

    public function getFormattedDateAttribute()
    {
    	return $this->date->format('F j, Y');
    }
}
