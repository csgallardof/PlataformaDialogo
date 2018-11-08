<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestOneController extends Controller
{
    public function testone()
    {
      return 'Usuarios';
    }


    public function show($id)
    {

      return "Mostrando el detalle del usuario {$id}";
    }
}
