@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-16">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Перегляд файлу для імпорту у таблицю
                </div>
                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th class="col-md-1">Назва</th>
                            <th class="col-md-1">Місто</th>
                            <th class="col-md-1">Вулиця</th>
                            <th class="col-md-1">Номер</th>
                            <th class="col-md-1">Керівник</th>
                            <th class="col-md-1">Телефон</th>
                            <th class="col-md-1">E-mail</th>
                            <th class="col-md-1">WWW</th>
                            <th class="col-md-1">К-я</th>
                            <th class="col-md-1">П</th>
                            <th class="col-md-1">К</th>
                        </thead>
                        <tbody>
                            @foreach ($file_arr as $string)
                                <tr>
                                    <td class="table-text"> {{ $string['name'] }} </td>
                                    <td class="table-text"> {{ $string['city'] }} </td>
                                    <td class="table-text"> {{ $string['street'] }} </td>
                                    <td class="table-text"> {{ $string['number'] }} </td>
                                    <td class="table-text"> {{ $string['director'] }} </td>
                                    <td class="table-text"> {{ $string['phone'] }} </td>
                                    <td class="table-text"> {{ $string['email'] }} </td>
                                    <td class="table-text"> {{ $string['www'] }} </td>
                                    <td class="table-text"> {{ $string['category_id'] }} </td>
                                    <td class="table-text"> {{ $string['pandus'] }} </td>
                                    <td class="table-text"> {{ $string['knopka'] }} </td>
                                </tr>
                            @endforeach
                            <form action="{{url('save_file')}}" method="POST" id="save_file">
                                {{ csrf_field() }}
                                <input type="hidden" name="load_file" form="save_file" value="{{$file_name}}">
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fa fa-btn fa-floppy-o"></i> Зберегти
                                </button>
                            </form>
                        </tbody>

                    </table> 
                </div>
            </div>
        </div>
    </div>
@endsection
