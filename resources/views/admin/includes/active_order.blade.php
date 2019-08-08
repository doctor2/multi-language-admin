<div class="form-group{{ $errors->has('active') ? 'has-error' : ''}}">
    {!! Form::label('active', 'Активность', ['class' => 'control-label']) !!}
    <input name="active" type="hidden" value="0">
    {!! Form::checkbox('active', '1', old("active") ? old("active") : (!empty($item) ? $item->active : true)) !!}
    {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('order') ? 'has-error' : ''}}">
    {!! Form::label( 'order', 'Сортировка', ['class' => 'control-label']) !!}
    {!! Form::number( 'order', old("order") ? old("order") : (!empty($item) ? $item->order : 10)
    , ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('order', '<p class="help-block">:message</p>') !!}
</div>
