@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-12">
            <h1 class="text-center">
                @if($category->id)
                    Редагувати категорію "{{$category->name}}"
                @else
                    Створити категорію
                @endif
            </h1>
            @if($category->id)
                {!! Form::model($category, ['url' => url('categories', [$category->id, 'edit'])]) !!}
            @else
                {!! Form::model($category, ['action' => 'CategoriesController@store']) !!}
            @endif
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Имя</label>
                {!! Form::text('name', old('name') ?: $category->name ?: '', ['class' => 'form-control',]) !!}
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                <label for="comment">Коментар</label>
                {!! Form::text('comment', old('comment') ?: $category->comment ?: '', ['class' => 'form-control', ]) !!}
                {!! $errors->first('comment', '<p class="help-block">:message</p>') !!}
            </div>
            <button class="btn btn-primary">@if($category->id)✏️ Редагувати@else➕ Створити@endif</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
