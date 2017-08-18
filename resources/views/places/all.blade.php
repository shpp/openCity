@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            @role('admin')
            <a href="{{ url('places/create') }}" class="btn btn-primary right">➕ Додати місце</a>
            @endrole
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
                                </div>
                            </th>
                            <th class="col-md-2">Доступність</th>
                            <th class="col-md-2">Додаткова інфо.</th>
                            <th class="col-md-1">Адреса</th>
                            </thead>
                            <tbody>
                            @foreach ($places as $place)
                                <tr>
                                    <td class="table-text"><a
                                                href="{{ url('places', $place->id) }}">{{$place->name }}</a></td>
                                    <td class="table-text">
                                        <div>{{$place->category->name}}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            @if (count($place['accessibility']) > 0)
                                                @foreach ($place['accessibility'] as $item)
                                                    {{$item->accessibilityTitle->name}}<br>
                                                @endforeach
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            @if (count($place['parameter']) > 0)
                                                @foreach ($place['parameter'] as $item)
                                                    {{$item->parameterTitle->name}} : {{$item->value}} <br>
                                                @endforeach
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        {{$place->city}}<br>
                                        {{$place->street}}<br>
                                        {{$place->number}}
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
