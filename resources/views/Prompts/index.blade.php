@extends('Layouts.layout')

@section('title', __('general.prompts') . ' | ' . config('app.name'))

@section('content')
    <div class="grid-x">
        {{ Breadcrumbs::render('prompts.index') }}
    </div>

    <div class="grid-x">
        <div class="cell">
            <ul class="tabs" data-tabs id="prompts-tabs">
                <li class="tabs-title is-active">
                    <a href="#question-prompt" aria-selected="true">{{ __('prompt.question_prompt') }}</a>
                </li>
                <li class="tabs-title">
                    <a href="#main-prompt">{{ __('prompt.main_prompt') }}</a>
                </li>
            </ul>

            <div data-tabs-content="prompts-tabs">
                <div class="tabs-panel is-active" id="question-prompt">
                    <div>
                        {{ Form::textarea(
                            null,
                            null
                        ) }}
                    </div>
                    <div>
                        <button type="submit" class="button large black-button">
                            {{ __('general.save') }}
                        </button>
                    </div>
                </div>
                <div class="tabs-panel" id="main-prompt">
                    <div>
                        {{ Form::textarea(
                            null,
                            null
                        ) }}
                    </div>
                    <div>
                        <button type="submit" class="button large black-button">
                            {{ __('general.save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
