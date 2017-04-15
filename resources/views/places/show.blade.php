@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="bs-callout bs-callout-info" id="callout-helper-bg-specificity">
                <h3>{{ $place->name }}</h3>
                @if($place->short_name)
                    <h6>{{ $place->short_name }}</h6>
                @endif
                <div>
                    <span class="label label-primary">{{ $place->category->comment }}</span>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
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
                                    <li>
                                        {{ $access->accessibilityTitle->name }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <div>
                            {{ $place->comment }}
                        </div>
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
                                    {{--<div class="media-left">--}}
                                    {{--<a href="#">--}}
                                    {{--<img class="media-object" src="..." alt="...">--}}
                                    {{--</a>--}}
                                    {{--</div>--}}
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ $comment->comment }} {{ $comment->rating }}</h4>
                                        {{ $comment->author->name }} {{ Carbon\Carbon::parse($comment->created_at)->format('d.m.y H:i:s') }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <h5>Коментарів поки немає. Залиште перший</h5>
                    @endif

                    {!! Form::open(['url' => url('places', [$place->id, 'comments']), 'method' => 'post']) !!}
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
