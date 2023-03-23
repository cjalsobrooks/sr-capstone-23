@extends(Auth::user()->is_admin ? 'layouts.admin' : 'layouts.volunteer')


@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h2 class="h2"><span class="fw">Section: </span>section</h2>
      <h2 class="h2"><span class="fw">Lead: </span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>      
    </div>
    
    <div class="container mt-5">
      <select name="sectionId" type="text" class="form-control" id="sectionId"  required="">
          @foreach ($userSections as $section)
              <option value="{{$section->id}}">{{$section->name}}</option>
          @endforeach
      </select>
      <h2 id="message">Scheduled shifts:</h2>
      <div style="" class="editoptions col-12-sm my-4" id="showcalendar">
        <div style="max-height: 400px;" id="calendarSec"></div>
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
        slotMinTime: '12:00',
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
    @vite(['resources/js/sectionlead.js'])   
  @endprepend
  

@endsection