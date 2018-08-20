<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $primaryKey = 'id';

    /* Relacion entre Role y RoleUser */

    public function role() {
        return $this->hasMany('App\Role', 'id');
    }

    /* Relacion entre Usuario y RoleUser */

    public function usuario() {
        return $this->hasMany('App\User', 'id');
    }

}
