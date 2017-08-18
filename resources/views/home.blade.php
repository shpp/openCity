@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Початок</div>
                    <div class="panel-body">
                        {{--You are logged in!--}}
                        @if (session()->has('message'))
                            <span class="help-block">
                             <strong>{{Session::get('message') }}</strong>
                        </span>
                        @endif
                        <ul>
                            <li><a href="{{ url('/places') }}">Список місць</a> містить список для редагування місць які
                                будуть відображатись на мапі.
                            </li>
                            <li>У розділі "Довідники":
                                <ul>
                                    <li><a href="{{ url('/catalogue/categories') }}">Категорії</a> містить список
                                        категорій (школи, дит. садки тощо)
                                    </li>
                                    <li><a href="{{ url('/catalogue/param_name') }}">Назви параметрів</a> містить список
                                        параметрів таких як Керівник, телефон тощо
                                    </li>
                                    <li><a href="{{ url('/catalogue/acc_name') }}">Назви доступностей</a> містить список
                                        доступностей таких як пандус, кнопка виклику працівника
                                    </li>
                                </ul>
                            </li>
                            <li>
                                Для внесення в систему багатьох місць - використовуйте імпорт з Excel.
                                Потрібно зкачати зразок за посиланням:
                                <a href="{{ url('/import/import.xlsx') }}">Зкачати зразок файлу для завантаження
                                    данних </a>
                                Після його заповнення данними: <a href="{{ url('/load_file') }}">Завантажити данні</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
