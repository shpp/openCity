<!doctype html>
<html lang="uk_UA">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Open City</title>
    <link rel="stylesheet" href="{{ elixir('assets/css/map.css') }}">
</head>
<body>
<nav class="nav has-shadow">
    <div class="container">
        <div class="nav-left">
            <a class="nav-item">
                <h2>OpenCity</h2>
            </a>
            <a class="nav-item is-tab is-active">Map</a>
            <a class="nav-item is-tab">Taxi</a>
            <a class="nav-item is-tab">About</a>
        </div>
    </div>
</nav>
<div class="columns">
    <div class="column is-4">
        <aside class="menu oc-filter-sidebar">
            <p class="menu-label">
                Заклади
            </p>
            <ul class="menu-list">
                @foreach($categories as $category)
                    <li>
                        <p class="control">
                            <label class="checkbox" id="cat{{ $category->id }}">
                                <input type="checkbox" for="cat{{ $category->id }}" checked>
                                {{ $category['name'] }}
                            </label>
                        </p>
                    </li>
                @endforeach
            </ul>

            <p class="menu-label">
                Доступності
            </p>
            <ul class="menu-list">
                @foreach($accessibilities as $accessibility)
                    <li>
                        <p class="control">
                            <label class="checkbox" for="acces{{ $accessibility->id }}">
                                <input type="checkbox" id="access{{ $accessibility->id }}" checked>
                                {{ $accessibility->accessibilityTitle->name }}
                            </label>
                        </p>
                    </li>
                @endforeach
            </ul>
        </aside>
    </div>
</div>
<div class="oc-main-map">
    <map name="Ukraine">
        <div id="js-main-map" class="oc-main-map-holder"></div>
    </map>
</div>

<script src="{{ elixir('js/map.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap"></script>
</body>
</html>