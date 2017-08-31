@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-1 col-sm-10">
            <!-- Current Tasks -->
            @if (count($categories) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">Список категорій</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif
                        <table class="table table-striped task-table">
                            <thead>
                            <th class="col-md-2">Назва</th>
                            <th class="col-md-5">Коментар</th>
                            @role('admin')
                            <th class="col-md-2">
                                <a href="{{ url('categories/create') }}" class="btn btn-primary right">➕ Додати категорію</a>
                            </th>
                            @endrole
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td><a href="{{ url('categories', [$category->id]) }}">{{$category->name}}</a></td>
                                    <td>{{$category->comment}}</td>
                                    @role('admin')
                                    <td>
                                        <a href="{{ url('categories', [$category->id, 'edit']) }}" class="btn btn-info">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        {!! Form::open(['url' => url('categories', [$category->id, 'delete']), 'method' => 'delete', 'style' => 'display: inline-block']) !!}
                                            <button class="btn btn-danger" onclick="return confirm('really')"><i class="fa fa-trash-o"></i></button>
                                        {!! Form::close() !!}
                                    </td>
                                    @endrole
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
