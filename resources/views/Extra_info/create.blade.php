@extends('Layouts.layout')

@section('title', __('general.nuevo', ['object' => __('general.extra_info')]) . ' | ' . config('app.name'))

@section('content')
    <div class="grid-x">
        <div class="small-12">
            {!! Form::open([
                'url' => route('extra_info.store'),
                'method' => 'POST',
                'files' => true,
                'class' => 'form-horizontal',
                'id' => 'formulario',
                'name' => 'extra_info',
            ]) !!}
                {!! Honeypot::generate('my_name', 'my_time') !!}
                @include('Extra_info.Elements.form')
            {{ Form::close() }}
        </div>
    </div>
@endsection
