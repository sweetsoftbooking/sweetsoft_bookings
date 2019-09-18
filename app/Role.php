<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table='roles';

    public function role_user()
    {
        return $this->belongsTo('App\Role_User', 'role_id', 'id');
    }
}
