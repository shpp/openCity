<!DOCTYPE html>
<html>
    <head>
        <title> I'm a teapot </title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }

            .red {color: red;}
        </style>
    </head>
    <body>
    <a class="navbar-brand" href="{{ url('/') }}">Home</a>
        <div class="container">
            <div class="content">
                <div class="title">418  I'm a teapot</div>
                <div class="title red">You are baned!</div>
            </div>
        </div>
    </body>
</html>
