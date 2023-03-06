@extends('layouts.admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<h4 class="fw-bold my-4" style="font-family:nunito;">Editing schedule : <span class="text-muted" style="font-family:nunito;">{{$vol->first_name}} {{$vol->last_name}}</span></h4>
<div class="row">
  <div class="col-sm-6">
    <label for="sectionId2" class="form-label">Choose section
    </label>
    <select name="sectionId2" type="text" class="form-control" id="sectionId2"  required="">
      @foreach ($sections as $section)
        <option value="{{$section->id}}">{{$section->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="col-sm-6">
    <label for="locationoptions" class="form-label">Choose section location
    </label>
    <div class="input-group has-validation">
      <select class="form-control" id="locationoptions" name="locationoptions">

      </select>
    </div>
  </div>
</div>
<div style="" class="editoptions col-12-sm my-4" id="showcalendar">
  <div style="max-height: 400px;" id="calendar"></div>
</div>
<input type="hidden" id="volId-hidden" name="volId-hidden" value="{{$vol->id}}">
</main>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
<script>

      var calendarEl = document.getElementById('calendar');
            
      var calendar = new FullCalendar.Calendar(calendarEl, {
        allDaySlot: false,
        initialView: 'listWeek',
        initialDate: '2023-06-02',
        headerToolbar: {
          left: 'prev next',
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


        function DynamicForm3(sectionIdTag, locationOptionsTag) {
        let sectionId = document.querySelector(sectionIdTag).value
        let options = document.getElementById(locationOptionsTag);
        var xhttp = new XMLHttpRequest();
        xhttp.open("get", "/findlocations/" + sectionId, true);
        xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
        xhttp.send();
        xhttp.onload = function(){
          while (options.firstChild) {
            options.removeChild(options.firstChild);
          }
          let nodeDefault = document.createElement("option");
          nodeDefault.value="0";
          nodeDefault.innerHTML="--- select a location ---";
          let obj = JSON.parse(xhttp.response)
          options.appendChild(nodeDefault);
          for(var i = 0; i < obj.length; i++){
            let node = document.createElement("option");
            node.value = `${String(obj[i].id)}`;
            node.innerHTML = `${String(obj[i].name)}`;
            options.appendChild(node);
          }
        }
      }

      function DynamicForm4() {
        calendar.removeAllEvents();
        let sectionId = document.querySelector('#locationoptions').value;
        if(sectionId == ""){
          sectionId=0;
        }
        var xhttp = new XMLHttpRequest();
        xhttp.open("get", "/findshifts/" + sectionId, true);
        xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
        xhttp.send();
        xhttp.onload = function(){
          let obj = JSON.parse(xhttp.response)
          for(var i = 0; i < obj.length; i++){
            //call database on page load and render these with correct values in loop
            calendar.addEvent({
              title: `${String(obj[i].current)} out of ${String(obj[i].max)} / click to register`,
              start: String(obj[i].start),
              end: String(obj[i].end),
              url: `/registervol/${obj[i].id}/${document.querySelector("#volId-hidden").value}`
            });  
          }

          calendar.render();
        }
      }

      document.getElementById("sectionId2").addEventListener("click", ()=>{
        DynamicForm3('#sectionId2','locationoptions');
      });
      document.getElementById("locationoptions").addEventListener("change", DynamicForm4);

    //---------------Calendar definition statement-------------------------------


</script>
@endsection