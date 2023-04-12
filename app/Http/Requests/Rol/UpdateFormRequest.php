<?php

namespace App\Http\Requests\Rol;

use App\Models\Rol;
use App\Http\Requests\FormRequestBase;

class UpdateFormRequest extends FormRequestBase
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
    protected function add_message()
    {
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
        $rol = Rol::findOrFail($this->id);
        $rules = $rol->rules();
        $rules = $this->_remove_rules($this->except_rule, $rules);
        $rules = $this->_add_rules($this->add_rule, $rules);

        return $rules;
    }


    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */

    public function messages()
    {
        $messages = Rol::messages();
        $messages = $this->_add_messages($this->add_message(), $messages);

        return $messages;
    }
}
