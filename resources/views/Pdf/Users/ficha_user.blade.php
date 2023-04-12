@extends('Pdf.Layouts.layout')
@section('content')
    <div class="grid-x">
        <div class="small-12">
            <table>
                <thead>
                </thead>
                <tbody>
                    <tr>
                        <th>{{ __('general.nombre') }}</th>
                        <td>{{ $user->nombre }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('general.apellidos') }}</th>
                        <td>{{ $user->apellidos }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('general.email') }}</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('general.fecha_nacimiento') }}</th>
                        <td>{{ $user->fecha_nacimiento_formateada }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
