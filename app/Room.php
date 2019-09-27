<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table='rooms';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function events()
    {
        return $this->hasMany('App\Event', 'room_id', 'id');
    }

    public function bookings(){
        return $this->hasMany('App\Booking', 'room_id');
    }
}
