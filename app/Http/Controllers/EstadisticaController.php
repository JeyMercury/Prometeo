<?php

namespace App\Http\Controllers;

use App\Models\Estadistica;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EstadisticaController extends Controller
{
    public function index(Request $request)
    {

        $grafica_fechas_cumpleaños = Estadistica::grafica_fechas_cumpleannos();
        $grafica_evolucion_usuarios = Estadistica::grafica_evolucion_usuarios();
        $grafica_clasificacion_empleados = Estadistica::grafica_clasificacion_empleados();

        return view('Estadisticas.index', [
            'grafica_fechas_cumpleaños' => $grafica_fechas_cumpleaños,
            'grafica_evolucion_usuarios' => $grafica_evolucion_usuarios,
            'grafica_clasificacion_empleados' => $grafica_clasificacion_empleados
        ]);
    }
}
