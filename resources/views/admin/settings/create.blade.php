@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Создать настройку</div>
                    <div class="card-body">
                        <a href="{{ route('admin.settings.index') }}" title="Назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
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

                        {!! Form::open(['url' =>  route('admin.settings.store'), 'class' => 'form-horizontal', 'files' => true]) !!}
                            <div class="tab-content">
                                @include ('admin.settings.form', ['formMode' => 'create', 'prefix' => 'ru_', 'name' => 'На русском', 'show' => 'active' ])
                                
                                @include ('admin.settings.form', ['formMode' => 'create', 'prefix' => 'en_', 'name' => 'На английском', 'show' => null ])
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection