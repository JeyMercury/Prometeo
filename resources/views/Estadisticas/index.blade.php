@extends('Layouts.layout')

@section('title', 'Estadisticas'.' | '. config('app.name'))

@section('content')
<div class="grid-x">
    <div class="small-6">
        <grafica-barra
            data = "{{json_encode($grafica_fechas_cumpleaños['data'])}}"
            title = "{{$grafica_fechas_cumpleaños['title']}}"
            labels = "{{json_encode($grafica_fechas_cumpleaños['labels'])}}"
        >
        </grafica-barra>
    </div>
    <div class="small-6">
        <grafica-linea
            data = "{{json_encode($grafica_evolucion_usuarios['data'])}}"
            title = "{{$grafica_evolucion_usuarios['title']}}"
            labels = "{{json_encode($grafica_evolucion_usuarios['labels'])}}"
        >
        </grafica-linea>
    </div>
    <div class="small-6">
        <grafica-tarta
            data = "{{json_encode($grafica_clasificacion_empleados['data'])}}"
            title = "{{$grafica_clasificacion_empleados['title']}}"
            labels = "{{json_encode($grafica_clasificacion_empleados['labels'])}}"
        >
        </grafica-tarta>
    </div>

</div>
@endsection
