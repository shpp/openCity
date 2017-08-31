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
