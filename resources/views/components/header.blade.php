<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('') }}">{{ config('app.name', 'Місто для всіх') }}</a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @if (!Auth::guest())
                    <li><a href="{{ url('/home') }}">Додому</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">Довідники</a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('places') }}">Місця</a></li>
                            <li><a href="{{ url('categories') }}">Категорії</a></li>
                            @role('admin')
                            <li><a href="{{ url('users/all') }}">Користувачі</a></li>
                            <li><a href="{{ url('/catalogue/acc_name') }}">Назви доступностей</a></li>
                            <li><a href="{{ url('/parameters') }}">Назви параметрів</a></li>
                            <li><a href="{{ url('/parameter_types') }}">Типи параметрів</a></li>
                            @endrole
                        </ul>
                    </li>
                    @role('admin')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            Системні
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/destroy_null') }}">Видалити помилкові місця</a></li>
                            <li><a href="{{ url('/load_geo') }}">Проставити координати</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ url('/load_file') }}">Завантажити данні</a></li>
                    <li><a href="{{ url('/messages') }}">Перегляд повідомлень</a></li>
                    @endrole
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Увійти</a></li>
                    {{--<li><a href="{{ url('/register') }}">Зареєструватись</a></li>--}}
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Вийти
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
