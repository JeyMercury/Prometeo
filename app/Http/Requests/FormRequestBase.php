<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 * Todas las request deben heredar de esta para poder tener las funcionalidades de _remove_rules
 *
 */

class FormRequestBase extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }


    protected function _remove_rules($except_rule, $rules)
    {
        if (filled($except_rule)) {
            foreach ($except_rule as $key => $rule) {
                if (isset($rules[$key])) {
                    $rules[$key] = str_replace($rule, '', $rules[$key]);
                    if ($rules[$key] == "") {
                        unset($rules[$key]);
                    }
                }
            }
        }
        return $rules;
    }


    protected function _add_rules($add_rule, $rules)
    {
        if (filled($add_rule)) {
            foreach ($add_rule as $key => $rule) {
                if (!isset($rules[$key])) {
                    $rules[$key] = $rule;
                } else {
                    $rules[$key] .= '|' . $rule;
                }
            }
        }
        return $rules;
    }

    protected function _add_messages($add_message, $messages)
    {
        if (filled($add_message)) {
            $messages = array_merge($messages, $add_message);
        }
        return $messages;
    }
}
