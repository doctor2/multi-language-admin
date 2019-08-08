<div id="{{$prefix}}" class="tab-pane {{$show}}">
    <br />
    <h4>{{$name}}</h4>
    <p>
        <div class="form-group{{ $errors->has($prefix. 'name') ? 'has-error' : ''}}">
            {!! Form::label($prefix. 'name', 'Название *', ['class' => 'control-label']) !!}
            {!! Form::text($prefix. 'name', null, ['class' => 'form-control']) !!}
            {!! $errors->first($prefix. 'name', '<p class="help-block">:message</p>') !!}
        </div>
    </p>
</div>
@if (!$show)
    <h4>Общие поля</h4>
    <div class="form-group{{ $errors->has('value') ? 'has-error' : ''}}">
        {!! Form::label('value', 'Ключ', ['class' => 'control-label']) !!}
        {!! Form::text('value', null, ['class' => 'form-control']) !!}
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
    </div>
    @include ('admin.includes.active_order', ['item' =>  $city ?? null])
    <div class="form-group">
        {!! Form::submit($formMode === 'edit' ? 'Обновить' : 'Создать', ['class' => 'btn btn-primary']) !!}
    </div>
@endif
