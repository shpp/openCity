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


            <!-- Modal -->
            <div class="modal fade" id="addInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Додати елемент</h4>
                  </div>
                  <div class="modal-body">
                    <form action="{{url('catalogue/add')}}" method="POST" id="add">
                    <label for="name" class="col-md-4 control-label">Назва</label>
                    <input type="text" class="form-control" name="name" form="add">
                    <label for="comment" class="col-md-4 control-label">Коментар</label>
                    <input type="text" class="form-control" name="comment" form="add">
                    {{ csrf_field() }}
                    <input type="hidden" name="type" form="add" value="{{ $types }}">
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрити</button>
                    <!--<button type="button" class="btn btn-primary">Сохранить</button>-->
                    <button type="submit" class="btn btn-success btn-primary" form="add">
                        <i class="fa fa-btn fa-floppy-o"></i> Зберегти
                    </button>
                  </div>
                </div>
              </div>
            </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>№</th>
                            <th>Назва</th>
                            <th>Коментар</th>
                            <th> </th>
                            <!-- Add Button -->
                            <th class="text-right">                                         
                                <button type="submit" id="add-{{ $types }}" class="btn btn-info" data-toggle="modal" data-target="#addInfo">   <i class="fa fa-btn fa-plus"></i> Додати
                                </button>

                            </th>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <th class="table-text text-center">
                                        <div>
                                            {{$data->id}}                                            
                                        </div>
                                    </td>                                
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
                                        <form action="{{url('catalogue/save')}}" method="POST" id="form{{$data->id}}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" form="form{{$data->id}}" value="{{ $data->id }}">
                                            <input type="hidden" name="type" form="form{{$data->id}}" value="{{ $types }}">
                                            <button type="submit" id="save-{{ $data->id }}" class="btn btn-success btn-block">
                                                <i class="fa fa-btn fa-floppy-o"></i> Зберегти
                                            </button>
                                        </form>
                                    </td>
                                    <!-- Delete Button -->
                                    <td>
                                        <form action="{{url('catalogue/delete')}}" method="POST" id="form_del{{$data->id}}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" form="form_del{{$data->id}}" value="{{ $data->id }}">
                                            <input type="hidden" name="type" form="form_del{{$data->id}}" value="{{ $types }}">

                                            <button type="submit" id="delete-{{ $data->id }}" class="btn btn-danger btn-block">
                                                <i class="fa fa-btn fa-trash"></i> Видалити
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
