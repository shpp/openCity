@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
              <!-- Current Tasks -->
            @if (count($places) > 0)
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
                                <th class="col-md-5">Назва</th>
                                <th class="col-md-3">
                                    <div class="form-group">
                                    <label for="places_category">Категорія:</label>
                                    <select class="form-control" name="category" id="places_category"> 
                                    @if ( 0 == $current_category)
                                        <option selected value="0"> Обрати...
                                    @endif
                                    @foreach ($categories as $category)
                                        @if ( $category->id == $current_category)
                                            <option selected value="{{ $category->id }}"> {{ $category->name }}
                                        @else
                                            <option value="{{ $category->id }}"> {{ $category->name }}
                                        @endif
                                    @endforeach
                                    </select>
                                    </div>
                                </th>
                                <th class="col-md-2">Доступність</th>
                                <th class="col-md-2">Додаткова інфо.</th>
                                <th class="col-md-1">Адреса</th>
                                <th class="col-md-1 text-right"> 
                                <a href="{{ url('places/0/edit') }}" class="btn btn-info"><i class="fa fa-btn fa-plus"></i> Додати</a>
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($places as $place)
                                    <tr>
                                        <td class="table-text"><div>{{$place->name }}</div></td>
                                        <td class="table-text"><div>{{$place->category->name}}</div></td>
                                        <td class="table-text"><div>
                                            @if (count($place['accessibility']) > 0)
                                                @foreach ($place['accessibility'] as $item)
                                                {{$item->accessibilityTitle->name}}<br>
                                                @endforeach
                                            @endif
                                        </div></td>
                                        <td class="table-text"><div>
                                            @if (count($place['parameter']) > 0)
                                                @foreach ($place['parameter'] as $item)
                                                {{$item->parameterTitle->name}} : {{$item->value}} <br>
                                                @endforeach
                                            @endif
                                        </div></td>
                                        <td>
                                        {{$place->city}}<br>
                                        {{$place->street}}<br>
                                        {{$place->number}}
                                        </td>

                                        <!-- Edit Button -->
                                        <td>
                                        @if ($place->geo_place_id)
                                            <a href="{{ url('places/'.$place['id'].'/edit') }}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i></a>
                                        @else
                                            <a href="{{ url('places/'.$place['id'].'/edit') }}" class="btn btn-danger"><i class="fa fa-pencil-square-o"></i></a>
                                        @endif
                                        </td>
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
