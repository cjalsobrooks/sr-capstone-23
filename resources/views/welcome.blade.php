<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Welcome</title>  

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
        @vite(['resources/sass/welcome.scss','resources/js/app.js'])
        <!-- Styles -->


        <!-- Background image-->
        <style>
            body {
                background-image: 
                linear-gradient(to bottom, rgba(245, 246, 252, 0.52), rgba(0, 57, 71, 0.73)),
                url('https://images.squarespace-cdn.com/content/v1/615b1c3397012e292b69d5d3/46440191-5388-43e3-a82d-228c522211b8/DSC_4637.jpg?;');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                width: 100vw;
                height: 100vh;
                background-position: center, center;
                 
            }
        </style>
</head>
<body class="align-items-center">
    <header>
        <nav class="navbar navbar-light bg-dark">            
            <a class="navbar-brand" href="https://www.riverbendfestival.com/"><img src="https://images.squarespace-cdn.com/content/v1/615b1c3397012e292b69d5d3/d34d336a-8005-4100-8a3a-220ffa5d528c/40TH+LOGO+WHITE.png?format=1500w%20%20%22" alt = "Riverbend Logo" style="width:220px;"></a>
            
            @guest
                <h1 style="white-space:pre-wrap;text-align: left;vertical-align: left;font-weight: bold; font-size: 2vw; color: #FFFFFF">Welcome Volunteers!</h1>  
            @endguest
            @auth
                <h1 style="white-space:pre-wrap;text-align: left;vertical-align: left;font-weight: bold; font-size: 2vw; color: #FFFFFF">
                    Welcome {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                </h1>  
            @endauth
                           
            <ul class="nav justify-content-end" style="margin-right: 2.5em">  
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                        <a class="btn btn-warning" href="{{ route('login') }}" role="button" style="margin-right:1em">Login</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                        <a class="btn btn-secondary" href="{{ route('register') }}" role="button">Register</a>
                        <li>
                    @endif

                @endguest

                @auth 
                    <li class="nav-item">
                        <a class="btn btn-warning" href="/home" role="button" style="margin-right:1em">Home</a>
                    <li>
                    <li class="nav-item">
                        <a class="btn btn-secondary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endauth
        
            </ul>
        </nav>
    </header>

    <div class="container d-flex align-items-center justify-content-center" style="margin-top: 2.5em">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mx-auto">
                    <div class="card-body align-items-center">
                        <h3 class="card-title" style="text-align:center">There would be no Riverbend Festival without volunteers like you.<h1>

                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a class="btn btn-warning" type="button" href="https://www.riverbendfestival.com">Festival Information</a>
                            <a class="btn btn-warning" type="button" href="https://www.riverbendfestival.com/faq">FAQ/User Guide</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
        

</body>
</html>