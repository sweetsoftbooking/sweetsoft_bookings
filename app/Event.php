<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table='events';

    public function bookings()
    {
        return $this->hasMany('App\Booking', 'event_id', 'id');
    }
}
