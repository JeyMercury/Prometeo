<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    //Replicar en cada controlador, para indicar que métodos se excluyen del middleware de autenticación
    protected $except = [];

    public function __construct()
    {
        //Si se comenta esta linea, no es necesario estar autenticado para entrar en la aplicacion
        $this->middleware('auth', ['except' => $this->except]);
    }
}
