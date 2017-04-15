<!DOCTYPE html>
<html lang="uk_UA">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Місто для всіх') }}</title>

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="/css/bootstrap-select.min.css" media="all" rel="stylesheet" type="text/css"/>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    {{--todo: add fancy open graph and twitter card--}}
</head>
<body>
<div id="app">
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
                        @role('admin')
                        <li><a href="{{ url('users/all') }}">Користувачі</a></li>
                        <li><a href="{{ url('admin/places') }}">Список місць</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                Довідники
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/catalogue/categories') }}">Категорії</a></li>
                                <li><a href="{{ url('/catalogue/acc_name') }}">Назви доступностей</a></li>
                                <li><a href="{{ url('/parameters') }}">Назви параметрів</a></li>
                                <li><a href="{{ url('/parameter_types') }}">Типи параметрів</a></li>
                            </ul>
                        </li>
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
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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

    @yield('content')
</div>

<!-- Scripts -->
<script src="https://maps.googleapis.com/maps/api/js?key={{$google_api_key}}&callback=initMap"
        async defer>
</script>


<script src="/js/app.js"></script>

<script src="/js/mapinput.js"></script>

<!-- canvas-to-blob.min.js is only needed if you wish to resize images before upload.
 This must be loaded before fileinput.min.js -->
<script src="/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
     This must be loaded before fileinput.min.js -->
<script src="/js/plugins/sortable.min.js" type="text/javascript"></script>
<!-- purify.min.js is only needed if you wish to purify HTML content in your preview for HTML files.
     This must be loaded before fileinput.min.js -->
<script src="/js/plugins/purify.min.js" type="text/javascript"></script>
<!-- the main fileinput plugin file -->
<script src="/js/fileinput.js"></script>
<script src="/js/ua.js"></script>
<script>$("#file_fild").fileinput({'language': 'ua'});</script>
<script src="/js/bootstrap-select.js"></script>

<!-- bootstrap.js below is needed if you wish to zoom and view file content 
     in a larger detailed modal dialog -->

<!-- optionally if you need a theme like font awesome theme you can include 
    it as mentioned below -->
<!-- optionally if you need translation for your language then include 
    locale file as mentioned below -->

</body>
</html>
