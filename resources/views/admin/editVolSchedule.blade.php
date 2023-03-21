@extends('layouts.admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<h2 class="fw-bold my-4" style="">Editing schedule : <span class="text-muted" style="font-family:nunito;">{{$vol->first_name}} {{$vol->last_name}}</span></h2>
<h4 class="fw-bold my-4" style="">Register</h4>
<div class="row">
  <div class="col-sm-6">
    
    <label for="sectionId2" class="form-label">Choose section
    </label>
    <select name="sectionId2" type="text" class="form-control" id="sectionId2"  required="">
      <option value="0">--- select a section ---</option>
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
<h4 class="fw-bold my-4" style="">Unregister</h4>
<div class="table-responsive mt-4" id="inner-height">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">Section</th>
        <th scope="col">Location</th>
        <th scope="col">Name</th>
        <th scope="col">Start</th>
        <th scope="col">End</th>
        <th></th>
      </tr>
    </thead>
    <tbody id="responsivebody" class="shadow-sm">
       @include('partial.displayvolshifts')
    </tbody>
  </table>
</div>
</main>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
<script>

    //---------------Unregister Ajax action-------------------------------------
   let staticElement = document.getElementById('responsivebody');
   staticElement.addEventListener('click', (evt)=>{
     const link = evt.target.closest(".unregister")
     Unregister(link.dataset.value);
   });
   
   function Unregister(link){
      var xhttp = new XMLHttpRequest();
      xhttp.open("get", link, true);
      xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
      xhttp.send();
      xhttp.onload = function(){
        alert(xhttp.response);
        LoadCalendar();
        refreshValues('/refreshvolshifts/' + document.querySelector("#volId-hidden").value, 'responsivebody');
      }
   }

    //---------------Calendar definition statement-------------------------------
      var calendarEl = document.getElementById('calendar');
            
      var calendar = new FullCalendar.Calendar(calendarEl, {
        allDaySlot: false,
        initialView: 'list',
        initialDate: '2023-06-02',
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
                  LoadCalendar();
                  refreshValues('/refreshvolshifts/' + document.querySelector("#volId-hidden").value, 'responsivebody');
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
          let obj = JSON.parse(xhttp.response)
          if(obj.length > 0){
            let nodeDefault = document.createElement("option");
            nodeDefault.value="0";
            nodeDefault.innerHTML="--- select a location ---";
            options.appendChild(nodeDefault);
          }
          for(var i = 0; i < obj.length; i++){
            let node = document.createElement("option");
            node.value = `${String(obj[i].id)}`;
            node.innerHTML = `${String(obj[i].name)}`;
            options.appendChild(node);
          }
        }
      }

      function LoadCalendar() {
        calendar.removeAllEvents();
        let locationId = document.querySelector('#locationoptions').value;
        if(locationId == ""){
          locationId=0;
        }
        var xhttp = new XMLHttpRequest();
        xhttp.open("get", "/findshifts/" + locationId, true);
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
      document.getElementById("locationoptions").addEventListener("change", LoadCalendar);

</script>
@endsection