@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-12">
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
                                <th class="col-sm-5">Назва</th>
                                <th class="col-sm-2">Категорія</th>
                                <th class="col-sm-2">Доступність</th>
                                <th class="col-sm-2">Додаткова інфо.</th>
                                <th class="col-sm-1">Адреса</th>
                                <th class="col-sm-1 text-right">                      
                                    <form action="{{ url('places/edit/0') }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-info">
                                             <i class="fa fa-btn fa-plus"></i> Додати
                                        </button>
                                    </form>
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($places as $place)
                                    <tr>
                                        <td class="table-text"><div>{{$place['name'] }}</div></td>
                                        <td class="table-text"><div>{{$place['category']}}</div></td>
                                        <td class="table-text"><div>
                                            @if (count($place['accessibility']) > 0)
                                                @foreach ($place['accessibility'] as $item)
                                                {{$item->accessibilityTitle->name}}<br>
                                                @endforeach
                                            @endif
                                        </div></td>
                                        <td class="table-text"><div>
                                            @if (count($place['param']) > 0)
                                                @foreach ($place['param'] as $item)
                                                {{$item->parameterTitle->name}} : {{$item->value}} <br>
                                                @endforeach
                                            @endif
                                        </div></td>
                                        <td>
                                        {{$place['address']->city}} {{$place['address']->street}} {{$place['address']->number}}
                                        </td>

                                        <!-- Edit Button -->
                                        <td>
                                            <form action="{{ url('places/edit/'.$place['id']) }}" method="POST">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </button>
                                            </form>
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
