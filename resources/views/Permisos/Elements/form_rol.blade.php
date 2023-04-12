<div class="grid-x">
    <div class="small-6">
        {{ Form::input('text', 'name', null, ['label' => __('Nombre')]) }}
    </div>
</div>
<div class="grid-x">
    <div class="botones small-12">
        {!! Html::link(route('permisos.index'), __('general.cancelar'), ['class' => 'secondary button']) !!}
        {!! Form::submit(__('general.guardar'), ['class' => 'button']) !!}
    </div>
</div>
