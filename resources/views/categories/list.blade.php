@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            @role('admin')
            <a href="{{ url('categories/create') }}" class="btn btn-primary right">➕ Додати категорію</a>
            @endrole
            <!-- Current Tasks -->
            @if (count($categories) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Список місць
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-striped task-table">
                            <thead>
                            <th class="col-md-2">Назва</th>
                            <th class="col-md-5">Коментар</th>
                            @role('admin')
                            <th class="col-md-2"></th>
                            @endrole
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->comment}}</td>
                                    @role('admin')
                                    <td>
                                        <a href="{{ url('categories', [$category->id, 'edit']) }}" class="btn btn-info">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
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
