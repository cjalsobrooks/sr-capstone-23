<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    

<head>
  <title>Volunteer Welcome Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
  </style>
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
</head>
<body>

<nav class="navbar navbar-inverse">

  <div class="container-fluid">
    <div class="navbar-header">
        <a href="{{ url('https://www.riverbendfestival.com/') }}">
     <img src="https://images.squarespace-cdn.com/content/v1/615b1c3397012e292b69d5d3/d34d336a-8005-4100-8a3a-220ffa5d528c/40TH+LOGO+WHITE.png?format=1500w%20%20%22" alt = "Riverbend Logo" style="width:220px;"></a>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>     
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
       <ul class="nav navbar-nav navbar-right">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in">{{ __(' Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><span class="glyphicon glyphicon-user">{{ __(' Register') }}</a>
                                </li>
                            @endif
                    </ul>
                    @endguest
    </div>
  </div>
  <h1 class=" bg-info"style="text-align: center;vertical-align: middle;font-weight: bold; font-size: 100px; color: #6aa84f;">Welcome Volunteers!</h1>
</nav>    

</body>

</html>
