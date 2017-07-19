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
                    Повідомлення відвідувачів:
                </div>
                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                        <th class="col-md-1">Id</th>
                        <th class="col-md-2">Дата</th>
                        <th class="col-md-2">Від кого</th>
                        <th class="col-md-4">Текст</th>
                        <th class="col-md-1">Перглянуто</th>
                        <th class="col-md-1"></th>
                        <!-- Add Button -->
                        {{--<th class="col-md-1 text-right">--}}
                            {{--<button type="submit" id="add_parameter" class="btn btn-info" data-toggle="modal" data-target="#addInfo">   <i class="fa fa-btn fa-plus"></i> Додати--}}
                            {{--</button>--}}

                        {{--</th>--}}
                        </thead>
                        <tbody>
                        @foreach ($Messages as $message)
                            <tr>
                                <td class="table-text">
                                    <div>
                                        {{$message->id}}
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        {{$message->created_at}}
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        {{$message->email}}
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        {{$message->text}}
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        @if ($message->read))
                                        Так
                                        @else
                                            Ні
                                        @endif
                                    </div>
                                </td>
                                <!-- Save Button -->
                                {{--<td>--}}
                                    {{--<form action="{{url('parameters')}}/{{$param->id}}" method="POST" id="form{{$param->id}}">--}}
                                        {{--{{ csrf_field() }}--}}
                                        {{--{{ method_field('PUT') }}--}}
                                        {{--<button type="submit" id="save-{{ $param->id }}" class="btn btn-success btn-block">--}}
                                            {{--<i class="fa fa-btn fa-floppy-o"></i> Зберегти--}}
                                        {{--</button>--}}
                                    {{--</form>--}}
                                {{--</td>--}}
                                {{--<!-- Delete Button -->--}}
                                {{--<td>--}}
                                    {{--<form action="{{url('parameters')}}/{{ $param->id }}" method="POST" id="form_del{{$param->id}}">--}}
                                        {{--{{ csrf_field() }}--}}
                                        {{--{{ method_field('DELETE') }}--}}
                                        {{--<button type="submit" id="delete-{{ $param->id }}" class="btn btn-danger btn-block" onclick="return confirm('Видалити?')">--}}
                                            {{--<i class="fa fa-btn fa-trash"></i> Видалити--}}
                                        {{--</button>--}}
                                    {{--</form>--}}
                                {{--</td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
