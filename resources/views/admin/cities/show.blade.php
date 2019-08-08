@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Просмотр локации {{ $city->id }}</div>
                    <div class="card-body">

                        <a href="{{ route('admin.cities.index') }}" title="Назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <a href="{{ route('admin.cities.edit' , $city->id ) }}"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактировать</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => route('admin.cities.destroy', $city->id),
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
                                    <tr>
                                        <th>ID</th><td>{{ $city->id }}</td>
                                    </tr>
                                    <tr><th> Название(RU) </th><td> {{ $city->ru_name }} </td></tr>
                                    <tr><th> Название(EN) </th><td> {{ $city->en_name }} </td></tr>
                                    <tr><th> Ключ </th><td> {{ $city->value }} </td></tr>
                                    <tr><th> Сортировка </th><td> {{ $city->order }} </td></tr>
                                    <tr><th> Активность </th><td> {{ $city->active_html }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
