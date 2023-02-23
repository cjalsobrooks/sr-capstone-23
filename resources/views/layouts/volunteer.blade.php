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
    <!-- Scripts -->
    <script>
        //cross site request forgery token, required for api calls in .js files
        token = document.querySelector('meta[name="csrf-token"]').content;
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
        <!-- <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search"> -->
        <div class="navbar-nav">
          <div class="nav-item text-nowrap">
            <a class="dropdown-item nav-link px-3" href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
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
                  <a class="nav-link active" aria-current="page" href="/home">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Home
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/emailsupervisor">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Email Supervisor
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/riverbendmap">
                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                    Riverbend Map
                  </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/editusers">
                      <span data-feather="shopping-cart" class="align-text-bottom"></span>
                      View Group
                    </a>
                </li>
              </ul>
            </div>
          </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>