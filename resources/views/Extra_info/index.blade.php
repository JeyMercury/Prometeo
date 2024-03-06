@extends('Layouts.layout')

@section('title', __('general.extra_info') . ' | ' . config('app.name'))

@section('content')
    <div class="grid-x">
        {{ Breadcrumbs::render('extra_info.index') }}
    </div>

    <div class="grid-x">
        <div>
            {{ Html::link(
                route('extra_info.create'),
                __('+'),
                [
                    'class' => 'button large black-button',
                ]
            ) }}
        </div>
    </div>
@endsection
