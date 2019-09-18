<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_User extends Model
{
    protected $table='role_users';

   public function users()
   {
       return $this->hasMany('App\User', 'user_id', 'id');
   }

   public function roles()
   {
       return $this->hasMany('App\Role', 'role_id', 'id');
   }
}
