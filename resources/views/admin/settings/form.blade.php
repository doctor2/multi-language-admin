<div id="{{$prefix}}" class="tab-pane {{$show}}">
    <br />
    <h4>{{$name}}</h4>
    <p>
        <div class="form-group{{ $errors->has($prefix. 'name') ? 'has-error' : ''}}">
            {!! Form::label($prefix. 'name', 'Значение *', ['class' => 'control-label']) !!}
            {!! Form::textarea($prefix. 'name', null, ['class' => 'form-control', 'rows' => 3]) !!}
            {!! $errors->first($prefix. 'name', '<p class="help-block">:message</p>') !!}
        </div>
    </p>
</div>
@if (!$show)
    <h4>Общие поля</h4>
    <div class="form-group{{ $errors->has('key') ? 'has-error' : ''}}">
        {!! Form::label('key', 'Ключ *', ['class' => 'control-label']) !!}
        {!! Form::text('key', null, ['class' => 'form-control']) !!}
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('description') ? 'has-error' : ''}}">
        {!! Form::label('description', 'Описание', ['class' => 'control-label']) !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('order') ? 'has-error' : ''}}">
        {!! Form::label( 'order', 'Сортировка', ['class' => 'control-label']) !!}
        {!! Form::number( 'order', old("order") ? old("order") : (!empty($setting) ? $setting->order : 10)
        , ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('order', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group">
        {!! Form::submit($formMode === 'edit' ? 'Обновить' : 'Создать', ['class' => 'btn btn-primary']) !!}
    </div>
@endif
