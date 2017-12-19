@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
    <div class="container">
        <div class="col-md-8">
            <div style="height: 700px; width: 80vw">
                 {!! Mapper::render() !!}
            </div>
        </div>
    </div>
    <script src="js/markers.js" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js" async defer></script>
@endsection