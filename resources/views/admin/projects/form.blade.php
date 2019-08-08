<div id="{{$prefix}}" class="tab-pane {{$show}}">
    <br />
    <h3>{{$name}}</h3>
    <p>
        <div class="form-group{{ $errors->has($prefix. 'title') ? 'has-error' : ''}}">
            {!! Form::label($prefix. 'title', 'Название', ['class' => 'control-label']) !!}
            {!! Form::text($prefix. 'title', null, ['class' => 'form-control']) !!}
            {!! $errors->first($prefix. 'title', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group{{ $errors->has($prefix. 'additional') ? 'has-error' : ''}}">
            {!! Form::label($prefix. 'additional', $fieldsName['additional'], ['class' => 'control-label']) !!}
            {!! Form::textarea($prefix. 'additional', null, ['class' => 'form-control','rows' => 3]) !!}
            {!! $errors->first($prefix. 'additional', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group{{ $errors->has($prefix. 'additional_multi[]') ? 'has-error' : ''}}">
            @if(old($prefix. 'additional_multi') or !empty($project))
                @php
                    $multiKey = $prefix . 'additional_multi';
                @endphp
                @foreach(old($multiKey) ? old($multiKey) : $project->$multiKey as $additional_multi)
                        <div data-parentId>
                            <label for="{{$prefix}}additional_multi[]" class="control-label">Дополнительное множественное</label>
                        <input name="{{$prefix}}additional_multi[]" data-value type="text" style="width:450px;" value="{{$additional_multi}}"/>
                            {!! $errors->first($prefix. 'additional_multi', '<p class="help-block">:message</p>') !!}
                            <a style="color:red;" data-delete-field href="#"><button class="btn btn-primary btn-sm"><i class="fa fa-minus" aria-hidden="true"></i></button></a>
                            <a style="color:green;" data-add-field href="#"><button class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i></button></a>
                        </div>
                @endforeach
            @else
                <div data-parentId>
                    <label for="{{$prefix}}additional_multi[]" class="control-label">Дополнительное множественное</label>
                    <input name="{{$prefix}}additional_multi[]" data-value type="text" style="width:450px;" value=""/>
                    {!! $errors->first($prefix. 'additional_multi', '<p class="help-block">:message</p>') !!}
                    <a style="color:red;" data-delete-field href="#"><button class="btn btn-primary btn-sm"><i class="fa fa-minus" aria-hidden="true"></i></button></a>
                    <a style="color:green;" data-add-field href="#"><button class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i></button></a>
                </div>
            @endif
        </div>
    </p>
</div>
@if (!$show)
    <h4>Общие поля</h4>
    <div class="form-group{{ $errors->has('year') ? 'has-error' : ''}}">
        {!! Form::label('year', $fieldsName['year'], ['class' => 'control-label']) !!}
        {!! Form::text('year', null, ['class' => 'form-control', 'data-int' => '']) !!}
        {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group">
        {{Form::label('city_id', 'Город')}}
        {{Form::select('city_id',$arLocations,null,array('name'=>'city_id', "class" => "form-control"))}}
    </div>

    <div class="form-group {{ $errors->has('preview_image') ? 'has-error' : ''}}">
        {!! Form::label('preview_image', 'Превью ', ['class' => 'control-label']) !!}
        @if(isset($project))
            @if ($project->preview_image_full)
                <img src="{{ $project->preview_image_full }}"  class="small_image">
                {!! Form::file('preview_image', null, ['class' => 'form-control']) !!}
            @else
                <p>
                    <small>Изображение не найдено </small>
                    {!! Form::file('preview_image', null, ['class' => 'form-control']) !!}
                </p>
            @endif
        @else
            {!! Form::file('preview_image', null, ['class' => 'form-control']) !!}
        @endif

        {!! $errors->first('preview_image', '<p class="help-block">:message</p>') !!}
    </div>
    @include ('admin.includes.active_order', ['item' =>  $project ?? null])
    <div class="form-group">
        {!! Form::submit($formMode === 'edit' ? 'Обновить' : 'Создать', ['class' => 'btn btn-primary']) !!}
    </div>
@endif
