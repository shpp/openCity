<!DOCTYPE html>
<html lang="uk_UA">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Доступне місто</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
            z-index: 1;
        }

        .content {
            text-align: center;
            height: 100vh;
            width: 100%;
            z-index: 0;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .typeahead {
            width: 95%;
        }

        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }

        #right-bar {
            top: 10%;
            position: fixed;
            height: 80%;
            width: 400px;
            right: -390px;
            padding: 10px;
            background-color: #ecf0f1;
            box-sizing: border-box;
            border: solid #95a5a6;
        }

        #left-bar {
            top: 10%;
            position: fixed;
            height: 80%;
            width: 192px;
            left: 0;
            padding: 10px;
            background-color: #ecf0f1;
            box-sizing: border-box;
            border: solid #95a5a6;
        }

        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }


    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (auth()->guest())
        <div class="top-right links">
            <a href="{{ url('/login') }}">Увійти</a>
        </div>
    @else
        <div class="top-right links">
            <a href="{{ url('home') }}">Адмін панель</a>
        </div>
    @endif
    <div class="content">
        <div id="map"></div>
    </div>
    <div id="left-bar">

        <div class="accordion" id="accordion2">
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                        <strong>Категорії</strong>
                    </a>
                </div>
                <div id="collapseOne" class="accordion-body collapse in">
                </div>
            </div>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                        <strong>Параметри зручності</strong>
                    </a>
                </div>
                <div id="collapseTwo" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <label><input type="checkbox" id="check" checked> Пандус</label>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" id="submit_params">Застосувати</button>
    </div>
    <div id="right-bar">
        <div id="info"><h1>Open City</h1></div>
        <div id="infoAdd"><h1></h1></div>
        <div id="infoAcc"><h1></h1></div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="/js/mapinit.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{$google_api_key}}&callback=initMap" async defer></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
