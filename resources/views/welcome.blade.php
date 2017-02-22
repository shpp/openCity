<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Доступне місто</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
        <link rel="stylesheet" type="text/css" href="css/welcom.css">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Увійти</a>
                    {{--<a href="{{ url('/register') }}">Register</a>--}}
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
                            @foreach ($categories as $category)
                                <div class="accordion-inner">
                                    <label><input type="checkbox" name="cat[]" id="cat{{$category->id}}" value="{{$category->id}}" checked> {{$category->name}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                                <strong>Параметри зручності</strong>
                            </a>
                        </div>
                        <div id="collapseTwo" class="accordion-body collapse">
                            @foreach ($accessibilities as $accessibility)
                                <div class="accordion-inner">
                                    <label><input type="checkbox" name="acc[]" id="acc{{$accessibility->id}}" value="{{$accessibility->id}}">{{$accessibility->name}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <button class="buton" id="submit_params">Застосувати</button>
            </div>
            <div id="right-bar">
            {{--<div class="col-md-4 text-left" id="right-bar">--}}
                    {{--<input class="typeahead" type="text" placeholder="Пошук...">--}}
                <div  id="info"><h1>Open City</h1></div>
                <div  id="infoAdd"><h1></h1></div>
                <div  id="infoAcc"><h1></h1></div>
            </div>

        </div>

        <script src="js/jquery.js"></script>
        <script src="/js/mapinit.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{$google_api_key}}&callback=initMap"
        async defer>
        </script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>
