@extends('Layouts.layout')

@section('title', __('general.analytics') . ' | ' . config('app.name'))

@section('content')
    <div class="grid-x">
        {{ Breadcrumbs::render('analytics.index') }}
    </div>

    <div class="grid-x">
        <h1>{{ __('analytic.usage_stats') }}</h1>
        <div class="cell">
            <ul class="tabs" data-tabs id="example-tabs">
                <li class="tabs-title is-active">
                    Content
                </li>
        </div>
    </div>
@endsection
