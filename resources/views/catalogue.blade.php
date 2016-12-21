@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-1 col-sm-10">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $views }}
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Название</th>
                            <th>Комментарий</th>
                            <th> </th>
                            <!-- Add Button -->
                            <th class="text-right">                                         
                                <form action="{{url('catalogue/'.$types.'/add')}}" method="POST" id="form_{{$types}}">
                                    {{ csrf_field() }}
                                    <button type="submit" id="add-{{ $types }}" class="btn btn-info">   <i class="fa fa-btn fa-plus"></i> Add
                                    </button>
                                </form>
                            </th>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td class="table-text">
                                        <div>
                                            <input type="text" class="form-control" name="name" form="form{{$data->id}}" value="{{ $data->name }}">
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            <input type="text" class="form-control" name="comment" form="form{{$data->id}}" value="{{ $data->comment }}">
                                        </div>
                                    </td>
                                    <!-- Save Button -->
                                    <td>
                                        <form action="{{url('catalogue/'.$types.'/save')}}" method="POST" id="form{{$data->id}}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" form="form{{$data->id}}" value="{{ $data->id }}">
                                            <button type="submit" id="save-{{ $data->id }}" class="btn btn-success btn-block">
                                                <i class="fa fa-btn fa-floppy-o"></i> Save
                                            </button>
                                        </form>
                                    </td>
                                    <!-- Delete Button -->
                                    <td>
                                        <form action="{{url('catalogue/'.$types.'/delete'. $data->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" id="delete-{{ $data->id }}" class="btn btn-danger btn-block">
                                                <i class="fa fa-btn fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
@endsection
