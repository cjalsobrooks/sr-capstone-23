<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
    <!-- Scripts -->
    <script>
        //cross site request forgery token, required for api calls in .js files
        token = document.querySelector('meta[name="csrf-token"]').content;
    </script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
    <script>
        //-------------------------refresh partial views created------------------------
        function refreshValues(url,target) {

          const xhttp = new XMLHttpRequest();
          xhttp.open('GET', url);
          xhttp.setRequestHeader("X-CSRF-TOKEN", token); 
          xhttp.setRequestHeader('Content-type', 'application/json');
          xhttp.send();
          xhttp.onload = function() {
              let current = document.getElementById(target);
              String(xhttp.responseText);
              while(current.firstChild){
                current.removeChild(current.lastChild);
              }
              current.innerHTML = String(xhttp.responseText);
          }
        }
    </script>

    @vite(['resources/sass/admin.scss', 'resources/js/app.js'])
    @stack('js')
    
</head>
<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Admin Panel</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="form-control-dark w-100 rounded-0 border-0"></div>
        <div class="navbar-nav">
          <div class="nav-item text-nowrap">
        <div class="form-control-dark w-100 rounded-0 border-0"></div>
            <a style="background-color: rgba(0, 0, 0, 0.25); width: 114.891px; text-align:center;" class="dropdown-item nav-link px-3" href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                {{ __('Sign out') }}
            </a>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
         </form>

          </div>
        </div>
    </header>
    <div class="container-fluid" id="app">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3 sidebar-sticky">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/admin">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Home
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/editschedules">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Edit Schedules
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                    Rosters
                  </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/editusers">
                      <span data-feather="shopping-cart" class="align-text-bottom"></span>
                      Edit Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/riverbendmap">
                      <span data-feather="shopping-cart" class="align-text-bottom"></span>
                      Riverbend Map
                    </a>
                </li>
                @if(Auth::User()->is_section_lead == 1)
                  <li class="nav-item">
                    <a class="nav-link" href="/sectionlead">
                      <span data-feather="file" class="align-text-bottom"></span>
                      View Your Section
                    </a>
                  </li>
                @endif
              </ul>
            </div>
          </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
