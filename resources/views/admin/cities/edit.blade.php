@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Редактировать локацию #{{ $city->id }}</div>
                    <div class="card-body">
                        <a href="{{ route('admin.cities.index') }}" title="Назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a data-toggle="tab" class="active nav-link" href="#ru_">RU</a></li>
                            <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#en_">EN</a></li>
                        </ul>

                        {!! Form::model($city, [
                            'method' => 'PATCH',
                            'url' =>  route('admin.cities.update', $city->id),
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}
                            <div class="tab-content">
                                @include ('admin.cities.form', ['formMode' => 'edit', 'prefix' => 'ru_', 'name' => 'На русском', 'show' => 'active' ])

                                @include ('admin.cities.form', ['formMode' => 'edit', 'prefix' => 'en_', 'name' => 'На английском', 'show' => null ])
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
