@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-12">
            @role('admin')
            <a href="{{ url('categories', [$category->id, 'edit']) }}" class="text-right">✏️ Редагувати</a>
            @endrole
            <h1 class="text-center">Категорія "{{$category->name}}"</h1>
            @if($category->comment)
                <blockquote>{{$category->comment}}</blockquote>
            @endif
            @if (count($category->places))
                <div class="col-sm-offset-1 col-sm-10">
                    <!-- Current Tasks -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Список місць в категорії {{$category->name}}
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped task-table">
                                <thead>
                                <tr>
                                    <th>Назва</th>
                                    <th>Доступність</th>
                                    <th>Додаткова інформація</th>
                                    <th>Адреса</th>
                                    @role('admin')
                                    <th></th>
                                    @endrole
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($category->places as $place)
                                    <tr>
                                        <td class="table-text">
                                            <a href="{{ url('places', $place->id) }}">{{$place->name }}</a>
                                        </td>
                                        <td class="table-text">
                                            @if (count($place['accessibility']) > 0)
                                                @foreach ($place['accessibility'] as $item)
                                                    <a href="{{url('accessibility_titles', $item->accessibilityTitle->id)}}">
                                                        {{$item->accessibilityTitle->name}}
                                                    </a>
                                                    <br>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="table-text">
                                            @if (count($place['parameter']) > 0)
                                                @foreach ($place['parameter'] as $item)
                                                    {{$item->parameterTitle->name}}: {{$item->value}} <br>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            {{$place->city}}<br>
                                            {{$place->street}}<br>
                                            {{$place->number}}
                                        </td>
                                        @role('admin')
                                        <td>
                                            @if ($place->geo_place_id)
                                                <a href="{{ url('places', [$place['id'], 'edit']) }}"
                                                   class="btn btn-default">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                            @else
                                                <a href="{{ url('places', [$place['id'],'edit']) }}"
                                                   class="btn btn-danger">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                            @endif
                                        </td>
                                        @endrole
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            @endif
        </div>
    </div>
@endsection
