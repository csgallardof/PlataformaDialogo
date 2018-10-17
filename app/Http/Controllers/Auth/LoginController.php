<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {   
        //dd(Auth::user()->admin());

        if(Auth::user()->admin() == 1){
            //dd('admin');
            return '/admin/home';    
        }
        if(Auth::user()->admin() == 2){
           // dd('Participante');
           // return
        }

        if(Auth::user()->admin() == 3){
            //dd('Institución');
            return '/institucion/home';
        }

        if(Auth::user()->admin() == 4){
            //dd('ConsejoSectorial');
            return '/consejo-sectorial/home';
        }
        
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    


}
