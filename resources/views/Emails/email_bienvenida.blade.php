@php($body = unserialize($body))
@extends('Emails.Layouts.plantilla_default')

@section('content')
    <tr style="padding-left: 5px;">
        <td colspan="2" style="color: #555555; font-size: 16px; font-family: verdana;">
            <strong>
                {{ __('general.emails.bienvenida.titulo', ['name' => $body['nombre'].' '.$body['apellidos']])}}
            </strong>
        </td>
    </tr>
    <tr>
        <td style="height: 25px;"></td>
    </tr>
    <tr style="padding-left:5px; width: 600px;">
        <td colspan="2" style="margin-top:10px; color: #555555; font-size: 11px; font-family: verdana; text-align: justify;">
            {!!__('general.emails.bienvenida.body')!!}
        </td>
    </tr>
@endsection
