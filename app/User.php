<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'permissions'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'permissions' => 'json'
    ];

    public function bookings()
    {
        return $this->hasMany('App\Booking', 'user_id', 'id');
    }

    public function role_user()
    {
        return $this->hasMany(Role_User::class, 'user_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_users', 'user_id', 'role_id');
    }

    public function rooms()
    {
        return $this->hasMany('App\Room', 'user_id', 'id');
    }

    public function hasPermission($flag)
    {
        return in_array( $flag, $this->permissions);
    }
}
