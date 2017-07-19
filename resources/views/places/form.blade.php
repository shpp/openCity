@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if(isset($place))Створити@elseРедагувати@endif місце
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    <form action="{{ url('places') }}" method="POST" id="edit_form">
                        {{--todo: use laravel collective for this form --}}
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="hidden" id="id" name="id" value="">
                                {{ csrf_field() }}
                                <label for="name" class="col-md-6 control-label">Назва</label>
                                <textarea id="name" class="form-control" name="name" rows="3" required
                                          autofocus></textarea>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                <label for="short_name" class="col-md-6 control-label">Коротка назва</label>
                                <input class="form-control" id="short_name" name="short_name">
                                @if ($errors->has('short_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('short_name') }}</strong>
                                    </span>
                                @endif

                                <label for="comment" class="col-md-6 control-label">Коментар</label>
                                <textarea id="comment" class="form-control" name="comment" rows="3"></textarea>
                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif

                                <div class="form-group">
                                    <label for="category" class="col-md-6 control-label">Категорія</label><a
                                            href="{{ url('/catalogue/categories') }}">Додати</a>
                                    <select class="form-control" id="category" name="category">
                                        <option value="0">Нет категории</option>
                                        @foreach ($categories as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <strong>Доступність&nbsp;</strong>
                                        <a href="{{ url('/catalogue/acc_name') }}">Додати</a>
                                    </div>
                                    <div class="panel-body">
                                        @foreach ($accessibilityTitle as $item)
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="acc[]" value="{{$item->id}}">
                                                    {{$item->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>


                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <strong>Додаткові параметри&nbsp;</strong>
                                        <a href="{{ url('/catalogue/param_name') }}">Додати</a>
                                    </div>
                                    <div class="panel-body">
                                        @foreach ($parameterTitle as $item)
                                            <label class="col-md-6 control-label">{{$item->name}}:</label>
                                            <div class="col-md-8">
                                                <input class="form-control" name="param[{{$item->id}}]" value="">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div id="map"></div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Адреса</div>
                                        <div class="panel-body">
                                            <label class="radio-inline">
                                                <input type="radio" name="find_option" value="adr" checke>
                                                За адресою
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="find_option" value="gps">
                                                За координатами
                                            </label>
                                            <button id="find_address" class="btn btn-info">
                                                <i class="fa fa-btn fa-binoculars"></i> Пошук
                                            </button>
                                            <br><br>
                                            <label class="col-md-3 control-label">Місто:</label>
                                            <div class="col-md-9">
                                                <input class="form-control" name="city" value="">
                                            </div>

                                            <label class=" col-md-3 control-label">Вулиця:</label>
                                            <div class="col-md-9">
                                                <input class="form-control" name="street" value="">
                                            </div>

                                            <label class=" col-md-3 control-label">Буд. №:</label>
                                            <div class="col-md-9">
                                                <input class="form-control" name="number" value="">
                                            </div>
                                            <label class=" col-md-3 control-label">Широта(lat):</label>
                                            <div class="col-md-9">
                                                <input class="form-control" name="map_lat" value="">
                                            </div>
                                            <label class=" col-md-3 control-label">Довгота(lng):</label>
                                            <div class="col-md-9">
                                                <input class="form-control" name="map_lng" value="">
                                            </div>
                                            <label class=" col-md-3 control-label">Google id:</label>
                                            <div class="col-md-9">
                                                <input class="form-control" name="geo_place_id" value="">
                                            </div>
                                            <label class=" col-md-3 control-label">Коментар:</label>
                                            <div class="col-md-9">
                                                <input class="form-control" name="comment_adr" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-success" form="edit_form">
                                        <i class="fa fa-floppy-o"></i> Зберегти
                                    </button>
                                    @if(isset($place))
                                        <button class="btn btn-danger" form="del">
                                            <i class="fa fa-btn fa-trash"></i> Видалити
                                        </button>
                                        <a href="{{ url('places') }}" class="btn btn-warning">
                                            <i class="fa fa-btn fa-undo"></i> Відміна
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
