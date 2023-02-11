<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Welcome</title>  

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        @vite(['resources/js/app.js'])
        <!-- Styles -->


        <!-- Background image-->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                background-image: url('https://images.squarespace-cdn.com/content/v1/615b1c3397012e292b69d5d3/46440191-5388-43e3-a82d-228c522211b8/DSC_4637.jpg?');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
            }
        </style>

        <!-- WORK IN PROGRESS
            <div>
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                        @else
                        <div>
                            <a href="{{ route('login') }}" class="btn" role="button">Log in</a>
                        </div>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-info">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        -->
        
        <!-- Page-Text -->
        
        
    </head>

    <body class="antialiased">
    
        <header>
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ url('https://www.riverbendfestival.com/') }}">
                        <img src="https://images.squarespace-cdn.com/content/v1/615b1c3397012e292b69d5d3/d34d336a-8005-4100-8a3a-220ffa5d528c/40TH+LOGO+WHITE.png?format=1500w%20%20%22" alt = "Riverbend Logo" style="width:220px;">
                        </a>
                    </div>

                    <ul class="nav navbar-nav">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                    </ul>
                    @endguest
                </div>
            </nav>
        </header>
        
        <div class="sqs-block-content">
            <style>
                
            </style>
            <h1 style="white-space:pre-wrap;text-align: center;vertical-align: middle;font-weight: bold; font-size: 100px; color: #FFFFFF">Welcome Volunteers!</h1>
        </div>
        

    </body>
</html>
