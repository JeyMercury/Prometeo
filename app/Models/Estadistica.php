<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use Softeca\Library\Fechas;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Estadistica extends Model
{
    protected $table = false;

    public static function grafica_fechas_cumpleannos(){
        $datos_grafica = array();
        $datos_grafica['title'] = __('general.grafica_cumpleanos_empleados');
        $datos_grafica['labels'] = Fechas::get_meses_año();
        $datos_grafica['data'] = [];
        foreach($datos_grafica['labels'] as $numero_mes=> $nombre_mes){
            $usuarios = User::whereRaw('MONTH(fecha_nacimiento) = '.$numero_mes)
            ->select(DB::raw('count(*) as num_usuarios'))
            ->groupBy(DB::raw('MONTH(fecha_nacimiento)'))->first();
            $datos_grafica['data'][] = isset($usuarios->num_usuarios)?$usuarios->num_usuarios:0;
        }
        $datos_grafica['labels'] = array_values($datos_grafica['labels']);
        return $datos_grafica;
    }

    public static function grafica_evolucion_usuarios(){
        $datos_grafica = array();
        $datos_grafica['title'] = __('general.grafica_evolucion_empleados');
        $numero_meses_grafica = 6;
        $fecha_inicio=Carbon::now()->subMonth($numero_meses_grafica-1);

        for($i=0; $i<$numero_meses_grafica; $i++){
            $fecha=$fecha_inicio->copy()->addMonth($i)->endOfMonth();
            $usuarios = User::where('created_at', '<=', $fecha)
            ->select(DB::raw('count(*) as num_usuarios'))
            ->first();
            $mes = $fecha->format('n');
            $ano = $fecha->format('y');
            $datos_grafica['data'][] = $usuarios->num_usuarios;
            $datos_grafica['labels'][] = Fechas::get_mes_año($mes).' / '.$ano;
        }
        return $datos_grafica;
    }

    public static function grafica_clasificacion_empleados(){
        $datos_grafica = array();
        $datos_grafica['title'] = __('general.grafica_clasificacion_empleados');
        $users = User::all();
        $datos = array();
        foreach($users as $user){
            $roles_user = $user->getRoleNames();
            foreach($roles_user as $rol){
                if(isset($datos[$rol])){
                    $datos[$rol]++;
                }else{
                    $datos[$rol]=1;
                    $datos_grafica['labels'][] = $rol;
                    $datos_grafica['options'][] = $rol;
                }
            }
        }
        $datos_grafica['data'] = array_values($datos);
        return $datos_grafica;
    }
}
