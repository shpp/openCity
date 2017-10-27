<!DOCTYPE html>
<html lang="uk_UA">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Місто для всiх</title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="http://allfont.net/allfont.css?fonts=ukrainian-play" rel="stylesheet" type="text/css"/>
    {{--todo: bundle this styles --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/welcome.css">
    <link rel="stylesheet" href="css/materialize-social.css">    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{--TODO: opengraph--}}
    {{--todo: add fancy favicon--}}
    @include('components.analytics')
</head>
<body>
<aside>
    <ul id="nav-mobile" class="side-nav fixed">
        <li class="logo">
            <a href="{{ url('/') }}" class="brand-logo green-text">Мicто для вcix</a>
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li class="bold active">
                    <a class="collapsible-header waves-effect waves-green active">
                        Категорії мiсць
                    </a>
                    <div class="collapsible-body">
                        <form id="categories-form">
                            <ul id="categories" style="max-height: 50vh; overflow: auto; position: relative;">
                                <li>
                                    <input type="checkbox" id="checkAll" class="filled-in" checked/>
                                    <label for="checkAll" class="black-text">Усі місця</label>
                                </li>
                                @foreach ($categories as $category)
                                    <li class="category-toggle">
                                        <input type="checkbox"
                                               name="cat[]"
                                               id="cat{{$category->id}}"
                                               value="{{$category->id}}"
                                               class="filled-in"
                                               checked/>
                                        <label for="cat{{$category->id}}" class="black-text">
                                            {{$category->name}}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                </li>
                <li class="bold">
                    <a class="collapsible-header waves-effect waves-green">Параметри зручності</a>
                    <div class="collapsible-body">
                        <form id="access-form">
                            <ul id="accessibility">
                                @foreach ($accessibilities as $accessibility)
                                    <li>
                                        <input type="checkbox"
                                               name="acc[]"
                                               id="acc{{$accessibility->id}}"
                                               value="{{$accessibility->id}}"
                                               class="filled-in"/>
                                        <label for="acc{{$accessibility->id}}" class="black-text">
                                            {{$accessibility->name}}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                </li>
                <li>
                    <a href="https://play.google.com/store/apps/details?id=me.kowo.opencity"
                        class="btn green waves waves-light"
                        target="_blank">
                            <i class="material-icons white-text">android</i>
                            Завантажити</a>
                </li>
            </ul>
        </li>
    </ul>
</aside>

<main>
    <div class="content">
        <div class="search-wrapper card">
            <input id="search-input" placeholder="Почніть набирати назву закладу..." class="typeahead">
            <i class="material-icons">search</i>
        </div>
        <div class="login-float-block">
            @if (auth()->guest())
                <a class="login-float__link modal-trigger" href="#login_modal">Увійти</a>
                @else
                <div class="user-control-block">{{ auth()->user()->name }}</div>
            @endif
        </div>
        <div id="map"></div>
        @include('components.right-bar')
        <a class="waves-effect waves-light btn modal-trigger main-trolley__button light-blue lighten-5 black-text" href="#low_trolley_modal">
            <i class="material-icons left">directions_bus</i>
            Низькополий тролейбус</a>
        <a class="waves-effect waves-light btn modal-trigger main-social-taxi__button yellow accent-2 black-text" href="#social_taxi_modal">
            <i class="material-icons left">local_taxi</i>
            Соціальне таксі</a>
    </div>
</main>

<footer class="page-footer green">
    <div class="custom-footer-container">
        <div class="footer-description">
            <h5 class="white-text">Соціальний проект «Місто для всіх»</h5>
            <p class="white-text text-lighten-4">
                Це карта доступності міста Кропивницький для людей з особливими потребами та батьків з маленькими
                дітьми, за допомогою якої можна визначити об’єкт на карті та дізнатися його координати, контакти та
                атрибути доступності (наявність пандуса та кнопки виклику).
                Ми працюємо над тим, щоб наповнити базу проекту і завди раді допомозі. Тож якщо ви бажаєте долучитися та
                зробити наше місто зручнішим для всіх &mdash; зв'яжіться з нами:
            </p>
            <ul class="footer-contacts white-text">
                <li>
                    <i class="material-icons">phone</i>
                    <a href="tel:+380952409572">+380952409572</a>
                </li>
            </ul>
        </div>
        <div class="footer-form">
            <h5 class="white-text footer-form-heading">Напишіть нам!</h5>
            <form id="message-form">
            {{ csrf_field() }}
            <!-- TODO -->
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="email" class="validate" name="email">
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="text" id="message" class="materialize-textarea"></textarea>
                        <label for="message">Ваш комментар</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn white green-text waves-effect waves-light"
                                type="submit"
                                name="action">
                            Вiдправити
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container row" style="margin: 0 auto;">
            <div class="col s6">
                © 2017 made with love by
                <a href="http://programming.kr.ua"
                   class="white-text"
                   target="_blank">
                    Ш++
                </a>
            </div>
            <div class="col s6 right-align">
                <a href="https://www.facebook.com/groups/1531774503500273/?fref=ts" target="_blank">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 167.657 167.657"
                         style="enable-background:new 0 0 167.657 167.657; width: 25px; height: 25px"
                         xml:space="preserve">
<g>
    <path style="fill:#fff;" d="M83.829,0.349C37.532,0.349,0,37.881,0,84.178c0,41.523,30.222,75.911,69.848,82.57v-65.081H49.626
        v-23.42h20.222V60.978c0-20.037,12.238-30.956,30.115-30.956c8.562,0,15.92,0.638,18.056,0.919v20.944l-12.399,0.006
        c-9.72,0-11.594,4.618-11.594,11.397v14.947h23.193l-3.025,23.42H94.026v65.653c41.476-5.048,73.631-40.312,73.631-83.154
        C167.657,37.881,130.125,0.349,83.829,0.349z"/>
</g></svg>
                    <span class="foot-facebook-link__text"> Місто для всіх</span>
                </a>
            </div>
        </div>
    </div>
</footer>
<!-- Modal Structure -->
<div id="low_trolley_modal" class="modal">
    <div class="modal-content">
        <h5 class="center-align">Місце знаходження низькополого тролейбусу</h5>
        Щоб дізнатися, де знаходиться низькополий тролейбус, наберіть цей номер: <a href="tel:+380957260939">(095)726-09-39</a>
    </div>
    <div class="modal-footer">
        <button href="#!" class="modal-action modal-close waves-effect waves-green btn">Добре</button>
    </div>
</div>
<div id="login_modal" class="modal shpp-theme">
    <div class="modal-content">
        <h5 class="center-align">Вхід в аккаунт</h5>
        <div class="section"></div>
        <div class="row">
            <form class="col s6" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="email" class="validate" name="email">
                        <label for="email">Електронна пошта</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" class="validate" name="password">
                        <label for="password">Пароль</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <input type="checkbox" id="login-remember-me" class="filled-in"/>
                        <label for="login-remember-me" class="black-text">Запам’ятати мене</label>
                    </div>
                </div>
                <div class="section"></div>
                <div class="row">
                    <button type="submit" class="btn btn-full">Продовжити</button>
                </div>
            </form>
            <div class="col s6">
                <div class="row">
                    <a class="col s12 waves-effect waves-light btn social facebook"
                        href="{{ url('/auth/facebook') }}">
                        <i class="fa fa-facebook"></i> Вхід через facebook</a>
                </div>
                <div class="row">
                    <a class="col s12 waves-effect waves-light btn social twitter"
                        href="{{ url('/auth/twitter') }}">
                        <i class="fa fa-twitter"></i> Вхід через twitter</a>
                </div>
                <div class="section"></div>
                <div class="row">
                    <a class="col s12 btn" href="{{ url('register') }}">Зареєструватися</a>
                </div>
                <div class="row">
                    <a class="col s12 btn btn-full" href="{{ url('/password/reset') }}">Забули пароль?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="social_taxi_modal" class="modal">
    <div class="modal-content">
        <h4 class="center-align">Соціальне таксі</h4>
        Щоб викликати соціальне таксі, вам потрібно зв'язатися з територіальним центром соціального обслуговування.
        Скористатися послугою можуть особи, які стоять на обліку в управлінні соціального захисту населення. Замовити таксі можливо у будні з 8:00 до 17:00 тільки у державні установи.
        <br><br>
        Фортечний район (за три доби тричі на місяць): <address>вул. Шатила, 12</address><br>
        телефони: <a href="tel:+38(0522)37-12-75">(0522) 37-12-75</a>, <a href="tel:+38(099)-666 29 41">(099) 666-29-41</a><br>
        e-mail: <a href="mailto:kirtercentr@mail.ru">kirtercentr@mail.ru</a><br><br>
        Подільський район (за добу): <address>вул. Архітектора Паученка 53/39</address><br>
        телефон: <a href="tel:+38(0522)22-08-67">(0522) 22-08-67</a><br>
        e-mail: <a href="mailto:len.upszn@krmr.gov.ua">len.upszn@krmr.gov.ua</a><br>
    </div>
    <div class="modal-footer">
        <button href="#!" class="modal-action modal-close waves-effect waves-green btn">Добре</button>
    </div>
</div>
{{--todo: bundle this scripts--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="/js/typeahead.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
<script src="https://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{$google_api_key}}&amp;callback=initMap&amp;language=uk_UA&amp;region=ES"
async defer></script>
<script src="/js/mapinit.js"></script>
<script src="/js/MassToggler.js"></script>
<script>
  $(document).ready(function(){
    MassToggler('aside input#checkAll', 'aside li.category-toggle input'); 
    $('.modal').modal();
  });
</script>
</body>
</html>
