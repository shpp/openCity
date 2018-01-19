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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="/css/bootstrap-select.min.css" media="all" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/b.min.css') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="/img/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/icons/favicon-16x16.png">
    <link rel="manifest" href="manifest.json">
    <link rel="mask-icon" href="/img/icons/safari-pinned-tab.svg" color="#4CAF50">
    <link rel="shortcut icon" href="/img/icons/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="/img/icons/mstile-144x144.png">
    <meta name="msapplication-config" content="/img/icons/browserconfig.xml">
    <meta name="theme-color" content="#4CAF50">

    <meta name="twitter:card" content="summary_large_image" />
    <meta property="twitter:title" content="Місто для всіх" />
    <meta property="twitter:image" content="/img/logo.png" />
    <meta property="twitter:description" content="Карта доступності міста Кропивницький для людей з інвалідністю та батьків з маленькими дітьми. На карті можна знайти об’єкт та дізнатися його координати, контакти та атрибути доступності (наявність пандуса та кнопки виклику)." />

    <meta property="og:title" content="Місто для всіх" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://opencity.shpp.me" />
    <meta property="og:image" content="/img/logo.png" />
    <meta property="og:description" content="Карта доступності міста Кропивницький для людей з інвалідністю та батьків з маленькими дітьми. На карті можна знайти об’єкт та дізнатися його координати, контакти та атрибути доступності (наявність пандуса та кнопки виклику)." />




    @yield('styles')
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
    @include('components.header')
    @yield('content')
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@yield('scripts')

</body>
</html>
