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
                    Назви параметрів
                </div>

                <!-- Modal -->
                <div class="modal fade" id="addInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Додати елемент</h4>
                            </div>
                            <div class="modal-body">
                                <form action="{{url('parameters')}}" method="POST" id="add">
                                    <label for="name" class="col-md-4 control-label">Назва</label>
                                    <input type="text" class="form-control" name="name" form="add">
                                    <label for="comment" class="col-md-4 control-label">Коментар</label>
                                    <input type="text" class="form-control" name="comment" form="add">
                                    <label for="sel" class="col-md-4 control-label">Тип параметру</label>
                                    <select class="selectpicker" name="parameter_type_id" form="add" id="sel"
                                            data-width="100%">
                                        @foreach ($parameterTypes as $type)
                                            <option value="{{ $type->id }}" data-thumbnail="{{ $type->icon }}"
                                                    style="background: #bfffd6;">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    {{ csrf_field() }}
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
                        <th class="col-md-1">№</th>
                        <th class="col-md-2">Назва</th>
                        <th class="col-md-4">Коментар</th>
                        <th class="col-md-3">Тип параметру</th>
                        <th class="col-md-1"></th>
                        <!-- Add Button -->
                        <th class="col-md-1 text-right">
                            <button type="submit" id="add_parameter" class="btn btn-info" data-toggle="modal"
                                    data-target="#addInfo"><i class="fa fa-btn fa-plus"></i> Додати
                            </button>

                        </th>
                        </thead>
                        <tbody>
                        @foreach ($parameters as $param)
                            <tr>
                                <th class="table-text text-center">
                                    <div>
                                        {{$param->id}}
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        <input type="text" class="form-control" name="name" form="form{{$param->id}}"
                                               value="{{ $param->name }}">
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        <input type="text" class="form-control" name="comment" form="form{{$param->id}}"
                                               value="{{ $param->comment }}">
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        <select class="selectpicker" name="parameter_type_id" form="form{{$param->id}}"
                                                id="sel{{$param->id}}" data-width="100%">
                                            @foreach ($parameterTypes as $type)
                                                @if ($type->id === $param->parameter_type_id)
                                                    <option selected value="{{ $type->id }}"
                                                            data-thumbnail="{{ $type->icon }}"
                                                            style="background: #bfffd6;">{{ $type->name }}</option>
                                                @else
                                                    <option value="{{ $type->id }}" data-thumbnail="{{ $type->icon }}"
                                                            style="background: #bfffd6;">{{ $type->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <!-- Save Button -->
                                <td>
                                    <form action="{{url('parameters')}}/{{$param->id}}" method="POST"
                                          id="form{{$param->id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <button type="submit" id="save-{{ $param->id }}"
                                                class="btn btn-success btn-block">
                                            <i class="fa fa-btn fa-floppy-o"></i> Зберегти
                                        </button>
                                    </form>
                                </td>
                                <!-- Delete Button -->
                                <td>
                                    <form action="{{url('parameters')}}/{{ $param->id }}" method="POST"
                                          id="form_del{{$param->id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" id="delete-{{ $param->id }}"
                                                class="btn btn-danger btn-block" onclick="return confirm('Видалити?')">
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
