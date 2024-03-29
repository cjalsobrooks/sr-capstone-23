@extends('layouts.volunteer')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h2 class="h2"><span class="fw-bold">Volunteer : </span><span class="text-muted" style="font-family:nunito;">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span></h2>
    </div>
    
    <div class="container mt-5">
      <h1 class="text-center">Welcome Volunteer!</h1>
      <p>
        Welcome to Riverbend! We thank you so much for volunteering with us. This dashboard will allow you to
        view your shift schedule and message your supervisor if you need anything.
      </p>

      <h2 id="schedule">Your Shift Schedule</h2>
      <div style="" class="editoptions col-12-sm my-4" id="showcalendar">
        <div style="max-height: 400px;" id="calendarSec"></div>
      </div>

      <div class="row mb-3 ">
        <div class="col-md-6 offset-3">                          
          <a class="btn btn-secondary" href="{{route('prod-schedule')}}" target=_blank>{{ __('Click here to view the production schedule.') }}</a>
        </div>
      </div>

    </div>
  </main>

  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
  <script>

      var calendarEl = document.getElementById('calendarSec');
            
      var calendar = new FullCalendar.Calendar(calendarEl, {
        allDaySlot: false,
        initialView: 'timeGrid',
        initialDate: '2023-06-02',
        slotMinTime: '14:00',
        duration: {days: 3},
        headerToolbar: {
          left: '',
          center: 'title',
          right: ''
        },
          eventClick: function(info) {
            info.jsEvent.preventDefault(); // don't let the browser navigate

            if (info.event.url) {
              var xhttp = new XMLHttpRequest();
                xhttp.open("get", `${info.event.url}`, true);
                xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
                xhttp.send();
                xhttp.onload = function(){
                  alert(xhttp.response);
                  calendar.removeAllEvents();
                }
            }
        }
      });

      document.addEventListener('DOMContentLoaded', function() {
        calendar.render();
      });
  </script>
  @prepend('js')
    
  @endprepend
  

@endsection