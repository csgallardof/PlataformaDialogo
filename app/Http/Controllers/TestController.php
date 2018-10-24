<?php
namespace App\Http\Controllers;

use App\Solucion;
use App\Pajustada;
use App\Actividad;
use App\ActorSolucion;
use App\Archivo;
use App\DetalleActividad;
use Mail;
use App\Politica;
use App\PlanNacional;
use App\IndiceCompetitividad;



use DB;
use File;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuditoriaController;
class TestController extends Controller
{

  public function test()
  {
      return 'helllooooooo';
  }
}

 ?>
