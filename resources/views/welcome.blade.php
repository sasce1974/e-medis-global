<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome to {{env("APP_NAME")}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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
            }

            .content {
                text-align: center;
            }
            #logo{
                position: absolute;
                min-width: 80px;
                width: 10%;
                top:1em;
                left:1em;
                height: auto;
            }
            .title {
                font-size: 4em;
                font-weight: bold;
                color: coral;
                position: absolute;
                bottom: 2rem;
                width: 100%;
                text-align: center;
                text-shadow: 0 0 5px white;
            }
            #title-image{
                position: relative;
                margin-top: 1rem;
            }
            #title-image img{
                width: 100%;
                height: auto;
            }
            #find-clinic-btn{
                background: darkgreen;
                color: white;
                border-radius: 8px;
                border: none;
                padding: 10px 20px;
                position: absolute;
                top: 30px;
                left:30px;
                font-size: 2rem;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <img id="logo" src="storage/logo.svg" alt="logo">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div id="title-image">
                    <img src="storage/title-image.jpg" alt="title image">
                    <button type="button" id="find-clinic-btn">FIND CLINIC</button>

                    <div class="title m-b-md">
                        E-MEDIS V 2.0
                    </div>
                </div>
                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
