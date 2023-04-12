<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Eventos\EventoRequest;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function api_eventos()
    {
        $user = Auth::user();
        $eventos = Evento::where('user_id', $user->id)->get();

        $eventosCalendario = $this->_formateaEventos($eventos);


        // TODO: Festivos iguales

        return $eventosCalendario;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventoRequest $request)
    {
        $evento = new Evento();
        DB::beginTransaction();
        $user = Auth::user();
        if ($evento->guardar($request, $user->id)) {
            DB::commit();
            return $evento;
        }
    }


    public function update(Evento $evento, EventoRequest $request)
    {
        $evento = Evento::find($evento->id);
        DB::beginTransaction();
        if ($evento->editar($request)) {
            DB::commit();
            return $evento->id;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evento = Evento::find($id);
        DB::beginTransaction();
        if ($evento->delete()) {
            DB::commit();
        }
    }

    /**
     * Transforma los eventos a un formato legible por el calendario.
     */
    private function _formateaEventos($eventos)
    {
        return collect($eventos->map(function ($e) {
            return [
                'id' => $e->id,
                'title' => $e->nombre,
                'allDay' => $e->todo_dia === 1,
                'dia' => $e->dia,
                'hora_inicio' => $e->hora_inicio,
                'hora_fin' => $e->hora_fin,
                'informacion' => $e->informacion,
                'color' => $e->color
            ];
        }));
    }

    public function calendario()
    {
        return view('Eventos.calendario');
    }
}
