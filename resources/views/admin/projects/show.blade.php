@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Просмотр портфолио {{ $project->id }}</div>
                    <div class="card-body">

                        <a href="{{ route('admin.projects.index') }}" title="Назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <a href="{{ route('admin.projects.edit' , $project->id ) }}" ><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактировать</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => route('admin.projects.destroy', $project->id),
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Удалить', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'onclick'=>'return confirm("Подтвердить удаление?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr><th> Заголовок(RU) </th><td> {{ $project->ru_title }} </td></tr>
                                    <tr><th> Заголовок(EN) </th><td> {{ $project->en_title }} </td></tr>
                                    <tr><th> Дополнительное <br>множественное(RU) </th><td>
                                        @foreach($project->ru_additional_multi as $award)
                                            {{$award}} <br>
                                        @endforeach </td></tr>
                                    <tr><th> Дополнительное <br>множественное(EN) </th><td>
                                        @foreach($project->en_additional_multi as $award)
                                            {{$award}} <br>
                                            @endforeach </td></tr>
                                    <tr><th> {{$fieldsName['additional']}} (RU) </th><td> {{ $project->ru_additional }} </td></tr>
                                    <tr><th> {{$fieldsName['additional']}} (EN) </th><td> {{ $project->en_additional }} </td></tr>
                                    <tr><th> {{$fieldsName['year']}} </th><td> {{ $project->year }} </td></tr>
                                    <tr><th> Город</th><td> {{ $project->city->name }} </td></tr>
                                    <tr><th> Превью </th><td> <img src="{{ $project->preview_image_full }}"  class="small_image"> </td></tr>
                                    <tr><th> Сортировка </th><td> {{ $project->order }} </td></tr>
                                    <tr><th> Активность </th><td> {{ $project->active_html }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
