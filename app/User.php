<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){

        return $this->belongsToMany( 'App\Role' ); 
    
    }


    public function evento() {

        return $this->belongsToMany('App\Evento', 'user_evento_solucion', 'user_id','evento_id');
    }


      public function sector(){

        return $this->belongsTo('App\Sector');
    }

     public function vsector(){

        return $this->belongsTo('App\Vsector');
    }

    public function scopeSearch($query, $name)
    {
        $query->where('apellidos','LIKE',"%$name%")
                    ->orwhere('name','LIKE',"%$name%")
                    ->orwhere('cedula','LIKE',"%$name%")
                    ->orwhere('celular','LIKE',"%$name%")
                    ->orwhere('telefono','LIKE',"%$name%")
                    ->orwhere('email','LIKE',"%$name%");
        
        $vsectors = Vsector::where('nombre_vsector','LIKE',"%$name%")->get();
        if(count($vsectors) > 0){
            foreach ($vsectors as $vsector) {
                $query->orwhere('vsector_id', '=',"$vsector->id" );
            }
        }

        $sectors= Sector::where('nombre_sector','LIKE',"%$name%")->get();
        if(count($sectors) > 0){
            foreach ($sectors as $sector) {
                $query->orwhere('sector_id', '=',"$sector->id" );
            }
        }   

        return $query;
        
    }

    public function actor_solucion()
    {
        return $this->hasMany('App\ActorSolucion','user_id','id');
    }

    public function actividad()
    {
        return $this->hasMany('App\Actividad','ejecutor_id','id');
    }

    public function admin()
    {
        $roles = $this->roles()->get();
        
        $is_admin = 0;
        foreach ($roles as $rol) {
            if($rol->id === 1){
                $is_admin++;
            }
        }
        //dd($is_admin);
        if($is_admin > 0){
            return true;    
        }else{
            //return true;
            return false;
        }
        

        //var_dump($roles);
        

    }

    
}