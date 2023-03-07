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

<!-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js%27%3E'></script>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');

          var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            initialDate: '2023-02-07',
            headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: [
              {
                title: 'All Day Event',
                start: '2023-02-01'
              },
              {
                title: 'Long Event',
                start: '2023-02-07',
                end: '2023-02-10'
              },
              {
                groupId: '999',
                title: 'Repeating Event',
                start: '2023-02-09T16:00:00'
              },
              {
                groupId: '999',
                title: 'Repeating Event',
                start: '2023-02-16T16:00:00'
              },
              {
                title: 'Conference',
                start: '2023-02-11',
                end: '2023-02-13'
              },
              {
                title: 'Meeting',
                start: '2023-02-12T10:30:00',
                end: '2023-02-12T12:30:00'
              },
              {
                title: 'Lunch',
                start: '2023-02-12T12:00:00'
              },
              {
                title: 'Meeting',
                start: '2023-02-12T14:30:00'
              },
              {
                title: 'Birthday Party',
                start: '2023-02-13T07:00:00'
              },
              {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: '2023-02-28'
              }
            ]
          });

                calendar.render();
              });
  </script>
@endpush -->



    @vite(['resources/sass/admin.scss', 'resources/js/app.js'])
    @stack('js')
    
</head>
<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Volunteer Panel</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
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
                @if(Auth::User()->is_section_lead)
                <li class="nav-item">
                  <a class="nav-link" href="/sectionlead">
                    <span data-feather="file" class="align-text-bottom"></span>
                    View Your Section
                  </a>
                </li>
                @endif
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/editusers">
                      <span data-feather="shopping-cart" class="align-text-bottom"></span>
                      View Group
                    </a>
                </li>  -->
              </ul>
            </div>
          </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>