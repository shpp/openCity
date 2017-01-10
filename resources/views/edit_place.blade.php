@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            @if (isset($place))
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Змінити місце 
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <form action="{{ url('places/save/') }}" method="POST">
                                <input type="hidden" id="id" name="id" value="{{ $place->id }}">
                                {{ csrf_field() }}
                                <label for="name" class="col-md-4 control-label">Назва</label>
                                <textarea id="name" class="form-control" name="name" rows="6"required autofocus>{{ $place->name }}</textarea>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                                <label for="comment" class="col-md-4 control-label">Коментар</label>
                                <textarea id="comment" class="form-control" name="comment" rows="3">{{ $place->comment }}</textarea>
                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif

                                <div class="form-group">
                                    <label for="category" class="col-md-4 control-label">Категорія</label><a href="{{ url('/catalogue/categories') }}">Додати</a>
                                    <select class="form-control" id="category" name="category">
                                        <option value="0"{{(NULL == $place->category_id)? "selected":""}}>Нет категории</option>
                                        @foreach ($сategories as $item)
                                            <option value="{{$item->id}}"{{($item->id == $place->category_id)? "selected":""}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                    <strong>Доступність&nbsp;</strong><a href="{{ url('/catalogue/acc_name') }}">Додати</a>
                                    </div>
                                    <div class="panel-body">
                                    @foreach ($accessibilityTitle as $item)
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="acc[]" value="{{$item->id}}" {{( in_array($item->id, $accessibility))? "checked":""}}>{{$item->name}}
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
                                        <label class="col-md-4 control-label">{{$item->name}}:</label>
                                        <div class="col-md-8">
                                        <input type="text" class="form-control" name="param[{{$item->id}}]" value="{{(isset($param[$item->id]))? $param[$item->id]:""}}">
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
 
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Адреса
                                    </div>
                                    <div class="panel-body">
                                        <label class="col-md-4 control-label">Місто:</label>
                                        <div class="col-md-8">
                                        <input type="text" class="form-control" name="city" value="{{$adr->city}}">
                                        </div>

                                        <label class="col-md-4 control-label">Вулиця:</label>
                                        <div class="col-md-8">
                                        <input type="text" class="form-control" name="street" value="{{$adr->street}}">
                                        </div>

                                        <label class="col-md-4 control-label">Буд. №:</label>
                                        <div class="col-md-8">
                                        <input type="text" class="form-control" name="number" value="{{$adr->number}}">
                                        </div>

                                        <label class="col-md-4 control-label">Широта(lat):</label>
                                        <div class="col-md-8">
                                        <input type="text" class="form-control" name="map_lat" value="{{$adr->map_lat}}">
                                        </div>

                                        <label class="col-md-4 control-label">Довгота(lng):</label>
                                        <div class="col-md-8">
                                        <input type="text" class="form-control" name="map_lng" value="{{$adr->map_lng}}">
                                        </div>
                                        <label class="col-md-4 control-label">Google id:</label>
                                        <div class="col-md-8">
                                        <input type="text" class="form-control" name="geo_place_id" value="{{$adr->geo_place_id}}">
                                        </div>                                        
                                        <label class="col-md-4 control-label">Коментар:</label>
                                        <div class="col-md-8">
                                        <input type="text" class="form-control" name="addres_comment" value="{{$adr->comment}}">
                                        </div>                                                                                    
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-floppy-o"></i> Зберегти
                                </button>


                                    <button type="submit" class="btn btn-danger"  form="del">
                                        <i class="fa fa-btn fa-trash"></i> Видалити
                                    </button>  
                                     <button type="submit" class="btn btn-warning"  form="esc">
                                        <i class="fa fa-btn fa-undo"></i> Відміна
                                    </button> 
                                </form>                                
                                <form action="{{url('places/delete/' . $place->id)}}" class="form-horizontal" method="POST" id="del">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }} 
                                </form>
                                           
                            </div>
                            <div class="col-sm-6">
                            </div>

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
