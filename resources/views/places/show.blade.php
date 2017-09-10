@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="bs-callout bs-callout-info" id="callout-helper-bg-specificity">
                <h3 class="text-center">{{ $place->name }}</h3>
                @if($place->short_name)
                    <h6>{{ $place->short_name }}</h6>
                @endif
                <div>
                    <span class="label label-primary">{{ $place->category->comment }}</span>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-6">
                            <address>
                                {{ $place->city }},
                                {{ $place->street }}
                                {{ $place->number }}
                            </address>
                            @if (!empty($place->paremeter))
                                @foreach($place->parameter as $parameter)
                                    {{ $parameter }}<br>
                                @endforeach
                            @endif
                            @if (!empty($place->accessibility))
                                <ul>

                                    @foreach($place->accessibility as $access)
                                        <li>{{ $access->accessibilityTitle->name }}</li>
                                    @endforeach

                                </ul>
                            @endif
                            <div>{{ $place->comment }}</div>
                            @role('admin')
                            <a href="{{ url('places', [$place->id, 'edit']) }}" class="btn btn-info">✏️ Редагувати</a>
                            @endrole
                        </div>
                        <div class="col-md-6">
                            <div id="place_map" style="width: 100%; height: 250px"></div>
                        </div>
                        {{--<a href="{{ url('place', [$place->id, 'suggestions', 'add']) }}" class="btn btn-primary right">Запропонувати зміни</a>--}}
                    </div>
                </div>
            </div>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Коментарі</h3>
                </div>
                <div class="panel-body">
                    @if(count($place->comments))
                        <ul class="media-list">
                            @foreach($place->comments as $comment)
                                <li class="media">
                                    <div class="media-body">
                                        <h4 class="media-heading">"{{ $comment->comment }} {{ $comment->rating }}"</h4>
                                        {{ $comment->author->name }} {{ Carbon\Carbon::parse($comment->created_at)->format('d.m.y H:i:s') }}
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
                                                data-target="#delete-comet-{{ $place->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <div class="modal fade" id="delete-comet-{{ $place->id }}" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="delete-comet-{{ $place->id }}Label">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h4 class="modal-title" id="delete-comet-{{ $place->id }}Label">
                                                            Дійсно видалити коментар?
                                                        </h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">
                                                            Скасувати
                                                        </button>
                                                        @if(auth()->user()->hasRole('admin') || auth()->user()->id == $comment->author_id)
                                                            {!! Form::open(['url' => url('place-comments', $comment->id),
                                                             'method' =>'delete', 'style' => 'display: inline;']) !!}
                                                            <input type="submit" class="btn btn-danger"
                                                                   value="Видалити">
                                                            {!! Form::close() !!}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <h5>Коментарів поки немає. Залиште перший</h5>
                    @endif

                    {!! Form::open(['url' => url('place-comments'), 'method' => 'post']) !!}
                    <input type="hidden" value="{{ $place->id }}" name="place-id">
                    <label for="comment"></label>
                    {!! Form::textarea('comment', '', ['class' => 'form-control', 'id'=> 'comment', 'rows' => 2]) !!}
                    @if(auth()->user())
                        <input type="submit" class="btn btn-primary" value="Додати коментар">
                    @else
                        Зайдіть, щоб лишити коментар.
                        <br>
                        <a href="{{ url('/login') }}">Увійти</a>
                        <a href="{{ url('/auth/twitter') }}" class="btn btn-twitter"><i class="fa fa-twitter"></i>
                            Twitter</a>
                        <a href="{{ url('/auth/facebook') }}" class="btn btn-facebook"><i class="fa fa-facebook"></i>
                            Facebook</a>
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
{{--todo: change to google maps--}}
@section('scripts')
    <script src="https://api-maps.yandex.ru/2.1/?lang=uk_UA" type="text/javascript"></script>
    <script type="text/javascript">
      ymaps.ready(function () {
        const placeMap = new ymaps.Map("place_map", {
          center: [{{ substr($place->map_lat, 0, 5) }}, {{ substr($place->map_lng, 0, 5)}}],
          zoom: 16,
          controls: []
        });
        const placeObject = new ymaps.Placemark([{{ substr($place->map_lat, 0, 5) }}, {{ substr($place->map_lng, 0, 5)}}], {
          balloonContent: '{{ $place->name }}',
          iconCaption: '{{ $place->name }}',
          preset: 'islands#blackStretchyIcon'
        });
        placeMap.geoObjects.add(placeObject);
        placeMap.controls.add(new ymaps.control.ZoomControl());
      });
    </script>
@endsection
