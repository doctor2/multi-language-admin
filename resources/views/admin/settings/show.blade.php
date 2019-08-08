@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Просмотр настройку {{ $setting->id }}</div>
                    <div class="card-body">

                        <a href="{{ route('admin.settings.index') }}" title="Назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <a href="{{ route('admin.settings.edit' , $setting->id ) }}" title="Edit setting"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактировать</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => route('admin.settings.destroy', $setting->id),
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Удалить', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete setting',
                                    'onclick'=>'return confirm("Подтвердить удаление?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $setting->id }}</td>
                                    </tr>
                                    <tr><th> Значение(RU) </th><td> {{ $setting->ru_name }} </td></tr>
                                    <tr><th> Значение(EN) </th><td> {{ $setting->en_name }} </td></tr>
                                    <tr><th> Ключ </th><td> {{ $setting->key }} </td></tr>
                                    <tr><th> Описание </th><td> {{ $setting->description }} </td></tr>
                                    <tr><th> Сортировка </th><td> {{ $setting->order }} </td></tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
