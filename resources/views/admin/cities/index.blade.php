@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Локации</div>
                    <div class="card-body">
                        <a href="{{ route('admin.cities.create') }}" class="btn btn-success btn-sm" title="Добавить">
                            <i class="fa fa-plus" aria-hidden="true"></i> Добавить
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => route('admin.cities.index'), 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Поиск..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th>Название</th><th>Ключ</th><th>Активность</th><th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($cities as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td><td>{{ $item->value }}</td><td>{{ $item->active_html }}</td>
                                        <td>
                                            <a href="{{ route('admin.cities.show', $item->id) }}" title="Просмотреть"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{ route('admin.cities.edit', $item->id) }}" title="Редактировать"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => route('admin.cities.destroy', $item->id),
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-sm',
                                                        'title' => 'Удалить',
                                                        'onclick'=>'return confirm("Подтвердить удаление?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $cities->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
