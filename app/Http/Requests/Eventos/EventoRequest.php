<?php

namespace App\Http\Requests\Eventos;

use App\Models\Evento;
use App\Http\Requests\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequestBase
{
      /**
     * Reglas del modelo que se excluyen en esta Request
     *
     */
    protected $except_rule = [];

    /**
     * Reglas del modelo que se añaden en esta Request
     *
     */
    protected $add_rule = [];

    /**
    * Mensajes de validacion que se añaden al añadir una rule en $add_rule
    *
    */
    protected function add_message(){
        return [];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $evento = new Evento();
        return array_merge($evento->rules());
    }


    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */

    public function messages()
    {
        return Evento::messages();
    }
}
