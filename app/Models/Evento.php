<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{

    protected $table = 'eventos';

    public function rules(){
        return [
            'evento.nombre' => 'required',
            'evento.dia' => 'date',
            'evento.hora_inicio' => 'date_format:H:i',
            'evento.hora_fin' => 'date_format:H:i',
        ];
    }

    public static function messages (){
        return [
            'evento.title.required' => __('general.validaciones.evento.title'),
            'evento.title.dia' => __('general.validaciones.evento.dia'),
            'evento.title.hora_inicio' => __('general.validaciones.evento.hora_inicio'),
            'evento.title.hora_fin' => __('general.validaciones.evento.hora_fin'),
        ];
    }

    public function guardar(Request $request, $user_id){
        $request = (object)$request->evento;
        $this->nombre = $request->nombre;
        $this->dia = $request->dia;
        $this->todo_dia = $request->allDay;
        $this->hora_inicio = $request->hora_inicio;
        $this->hora_fin = $request->hora_fin;
        $this->color = $request->color;
        $this->informacion = isset($request->informacion)?$request->informacion:null;
        $this->user_id = $user_id;

        if (!$this->save()) {
            return false;
        }
        return true;
    }

    public function editar(Request $request){
        $request = (object)$request->evento;
        $this->nombre = $request->nombre;
        $this->dia = $request->dia;
        $this->todo_dia = $request->allDay;
        $this->hora_inicio = $request->hora_inicio;
        $this->hora_fin = $request->hora_fin;
        $this->color = $request->color;
        $this->informacion = $request->informacion;

        if (!$this->save()) {
            return false;
        }
        return true;
    }

}
