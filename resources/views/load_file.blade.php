@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-1 col-sm-10">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Завантажити файл для імпорту у таблицю місць</strong>
                </div>
                <div class="panel-body">
                    <form action="{{url('load_file')}}" method="POST" id="load" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label class="control-label">Обрати файл</label>
                        <input name="uploadfile" type="file" class="file" id="file_fild">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
