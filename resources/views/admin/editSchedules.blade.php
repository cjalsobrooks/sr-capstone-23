@extends('layouts.admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h2 class="h2"><span class="fw-bold">Admin : </span>{{ Auth::user()->first_name }}</h2>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
        <button id="showedit" type="button" class="btn btn-sm btn-outline-secondary">Edit Schedule</button>
        <button id="showcreate" type="button" class="btn btn-sm btn-outline-secondary">Create New</button>
      </div>
    </div>
  </div>

  <div class="toggleedit">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
    <div>
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar align-text-bottom" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
      Edit Options
    </button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item editoptionstoggle" href="#">Edit Volunteers</a></li>
      <li><a class="dropdown-item editoptionstoggle" href="#">Edit Section</a></li>
    </ul>
  </div>


    <div class="editoptions" id="editvol">
      <h2 class="fw-bold my-3">Edit Volunteers</h2>
      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <form id="voleditsearch" class="needs-validation" novalidate="" action="javascript:void(0);" method="">
            <label for="findvol2" class="form-label">Volunteers by last name
            </label>
            <input name="findfindvol2" type="text" class="form-control" id="findvol2"  required="">
          @csrf <!-- {{ csrf_field() }} -->
        </form>
        <div id="target3">
          @include('partial.displayvolunteers')
        </div>
      </div>
    </div>

    <div style="display:none;" class="editoptions" id="editsect">
      <div class="row">
        <h2 class="fw-bold my-3 ">Edit Section</h2>
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
  </div>
    <div style="display: none;" class="editoptions col-12-sm my-4" id="showcalendar">
      <div id="calendar"></div>
    </div>
  </div>

  

    <div style="display:none;" id="togglecreate">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <div>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar align-text-bottom" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
          Create Options
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item createoptionstoggle" href="#">Add Section</a></li>
          <li><a class="dropdown-item createoptionstoggle" href="#">Add Location</a></li>
          <li><hr class="dropdown-divider createoptionstoggle"></li>
          <li><a class="dropdown-item createoptionstoggle" href="#">Add Shift</a></li>
        </ul>
      </div>
    
    <div id="section" class="createoptions">
      <h2 class="fw-bold my-3">Add Section</h2>
        <form id="sectionform" class="needs-validation" novalidate="" action="javascript:void(0)" method="POST">
          <h4>Choose section leader</h4>
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="finduser1" class="form-label">Volunteers by last name
              </label>
              <input name="finduser1" type="text" class="form-control" id="finduser1"  required="">
            </div>
            <div class="col-sm-6">
              <label for="volselect" class="form-label">Name</label>
              <div class="input-group has-validation">
                <select class="form-control" id="volselect" name="volselect">
                </select>
                <input type="hidden" id="volId" name="volId" value="">
              </div>
            </div>
            <div class="col-sm-6">
              <h4>Section Name</h4>
              <input name="sectionname" type="text" class="form-control" id="section-name"  required="">
            </div>
            <div class="col-sm-12">
              <h4>Description</h4>
              <textarea name="section-description" type="text" class="form-control" id="section-description" placeholder="" value="" required=""></textarea>
            </div>
          </div>
          @csrf <!-- {{ csrf_field() }} -->
        </form>
        <button id="addsection" type="button" class="btn btn-success mt-4">Submit</button>
      
        <div style="border: 1px groove" class="d-flex flex-column align-items-stretch flex-shrink-0  my-4">
          <a href="/" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
      
            <svg class="bi me-2" width="30" height="24" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
              viewBox="0 0 200 200" enable-background="new 0 0 200 200" xml:space="preserve">
            <path fill="#282828" d="M100.232,149.198c-2.8,0-5.4-1.8-7.2-5.2c-22.2-41-22.4-41.4-22.4-41.6c-3.2-5.1-4.9-11.3-4.9-17.6
              c0-19.1,15.5-34.6,34.6-34.6s34.6,15.5,34.6,34.6c0,6.5-1.8,12.8-5.2,18.2c0,0-1.2,2.4-22.2,41
              C105.632,147.398,103.132,149.198,100.232,149.198z M100.332,54.198c-16.9,0-30.6,13.7-30.6,30.6c0,5.6,1.5,11.1,4.5,15.9
              c0.6,1.3,16.4,30.4,22.4,41.5c2.1,3.9,5.2,3.9,7.4,0c7.5-13.8,21.7-40.1,22.2-41c3.1-5,4.7-10.6,4.7-16.3
              C130.832,67.898,117.132,54.198,100.332,54.198z"/>
            <path fill="#282828" d="M100.332,105.598c-10.6,0-19.1-8.6-19.1-19.1s8.5-19.2,19.1-19.2c10.6,0,19.1,8.6,19.1,19.1
              S110.832,105.598,100.332,105.598z M100.332,71.298c-8.3,0-15.1,6.8-15.1,15.1c0,8.3,6.8,15.1,15.1,15.1c8.3,0,15.1-6.8,15.1-15.1
              C115.432,78.098,108.632,71.298,100.332,71.298z"/>
            </svg>
            <span class="fs-5 fw-semibold">Current Sections</span>
          </a>

          <div id ="target1" class="shadow-sm list-group list-group-flush border-bottom scrollarea">
            @include('partial.displaysections')
          </div>
        </div>
      </div>

      

    <div id="location" style="display:none;" class="createoptions">
      <h2 class="fw-bold my-3">Add Location</h2>
      <form id="locationform" class="needs-validation" novalidate="" action="javascript:void(0)" method="POST">
        <div class="row g-3">
          <div class="col-sm-6">
            <h4>Choose Section</h4>
            <select name="sectionId" type="text" class="form-control" id="sectionId"  required="">
              @foreach ($sections as $section)
                <option value="{{$section->id}}">{{$section->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-sm-6">

          </div>
          <div class="col-sm-6">
            <h4>Location Name</h4>
            <div class="input-group has-validation">
              <input class="form-control" id="location-name" name="locationname">
            </div>
          </div>
          <div class="col-sm-12">
            <h4>Description</h4>
            <textarea name="locationDescription" type="text" class="form-control" id="location-description" placeholder="" value="" required=""></textarea>
          </div>
        </div>
        @csrf <!-- {{ csrf_field() }} -->
      </form>
      <button id="addlocation" type="button" class="btn btn-success mt-4">Submit</button>

      <div style="border: 1px groove" class="d-flex flex-column align-items-stretch flex-shrink-0  my-4">
        <a href="/" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
    
          <svg class="bi me-2" width="30" height="24" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 200 200" enable-background="new 0 0 200 200" xml:space="preserve">
          <path fill="#282828" d="M100.232,149.198c-2.8,0-5.4-1.8-7.2-5.2c-22.2-41-22.4-41.4-22.4-41.6c-3.2-5.1-4.9-11.3-4.9-17.6
            c0-19.1,15.5-34.6,34.6-34.6s34.6,15.5,34.6,34.6c0,6.5-1.8,12.8-5.2,18.2c0,0-1.2,2.4-22.2,41
            C105.632,147.398,103.132,149.198,100.232,149.198z M100.332,54.198c-16.9,0-30.6,13.7-30.6,30.6c0,5.6,1.5,11.1,4.5,15.9
            c0.6,1.3,16.4,30.4,22.4,41.5c2.1,3.9,5.2,3.9,7.4,0c7.5-13.8,21.7-40.1,22.2-41c3.1-5,4.7-10.6,4.7-16.3
            C130.832,67.898,117.132,54.198,100.332,54.198z"/>
          <path fill="#282828" d="M100.332,105.598c-10.6,0-19.1-8.6-19.1-19.1s8.5-19.2,19.1-19.2c10.6,0,19.1,8.6,19.1,19.1
            S110.832,105.598,100.332,105.598z M100.332,71.298c-8.3,0-15.1,6.8-15.1,15.1c0,8.3,6.8,15.1,15.1,15.1c8.3,0,15.1-6.8,15.1-15.1
            C115.432,78.098,108.632,71.298,100.332,71.298z"/>
          </svg>
          <span class="fs-5 fw-semibold">Current Locations</span>
        </a>

        <div id ="target2" class="shadow-sm list-group list-group-flush border-bottom scrollarea">
          @include('partial.displaylocations')
        </div>
      </div>
    </div>

  <div id="shift" style="display:none;" class="createoptions">
      <h2 class="fw-bold my-3">Add Shift</h2>
      <form id="emailform" class="needs-validation" novalidate="" action="" method="POST">
        <div class="row g-3">
          <div class="col-sm-6">
            <h4>Choose Section</h4>
            <div class="input-group has-validation">
              <select class="form-control" id="sectionId3" name="sectionId3">
                @foreach ($sections as $section)
                  <option value="{{$section->id}}">{{$section->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <h4>Choose Location</h4>
            <div class="input-group has-validation">
              <select class="form-control" id="locationoptions2" name="locationoptions2">
              </select>
            </div>
          </div>

          <div class="col-sm-6">
            <h4>Shift Name</h4>
            <input name="shiftName" type="text" class="form-control" id="shift-name"  required="">
          </div>
          <div class="col-sm-12">
            <h4>Description</h4>
            <textarea name="shiftDescription" type="text" class="form-control" id="shift-description" placeholder="" value="" required=""></textarea>
          </div>
          <div class="col-sm-6">
            <h4>Day</h4>
            <input name="shiftDay" type="date" class="form-control" id="shift-day"  required="">
          </div>
        <div class="col-sm-6"></div>
          <div class="col-sm-6">
            <h4>Start Time</h4>
            <input name="startTime" type="time" class="form-control" id="start-time"  required="">
          </div>
          <div class="col-sm-6">
            <h4>End Time</h4>
            <input name="endTime" type="time" class="form-control" id="end-time"  required="">
          </div>
          <div class="col-sm-6">
            <h4>Number of Volunteers</h4>
            <input name="numVolunteers" type="number" class="form-control" id="num-volunteers"  required="">
          </div>
        </div>
        @csrf <!-- {{ csrf_field() }} -->
      </form>
      <button id="addshift" type="button" class="btn btn-success mt-4">Submit</button>
      <div style="display:none" class="row pt-4"> 
        @include('partial.displayshifts')
      </div>
    </div>
  </div>

  </main>
  
  @prepend('js')
    @vite(['resources/js/editschedules.js'])  
  @endprepend

  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
  <script>



      //---------------------------Create new DB entities---------------------------------
      function create(val) {
        // Form fields, see IDs above
        let createURL = '';
        let refreshURL = '';
        let targetDiv= '';
        let params;

        switch(val) {
        case 1:
          createURL = '/createsection';
          refreshURL = '/refreshsections';
          targetDiv = 'target1';
          params = {
            volId: document.querySelector('#volId').value,
            sectionName: document.querySelector('#section-name').value,
            sectionDescription: document.querySelector('#section-description').value
          }
          break;
        case 2:
          createURL = '/createlocation';
          refreshURL = '/refreshlocations';
          targetDiv = 'target2'
          params = {
            sectionId: document.querySelector('#sectionId').value,
            locationName: document.querySelector('#location-name').value,
            locationDescription: document.querySelector('#location-description').value
          }
          break;
        case 3:
          createURL = '/createshift';
          refreshURL = '';
          targetDiv = ''
          params ={
            locationId: document.querySelector('#locationoptions2').value,
            sectionId: document.querySelector('#sectionId3').value,
            shiftName: document.querySelector('#shift-name').value,
            shiftDescription: document.querySelector('#shift-description').value,
            shiftDay: document.querySelector('#shift-day').value,
            startTime: document.querySelector('#start-time').value,
            endTime: document.querySelector('#end-time').value,
            numVolunteers: document.querySelector('#num-volunteers').value
          }
          break;
      }

        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', createURL);
        xhttp.setRequestHeader("X-CSRF-TOKEN", token); 
        xhttp.setRequestHeader('Content-type', 'application/json');
        xhttp.send(JSON.stringify(params));
        xhttp.onload = function() {
            alert(xhttp.responseText);
            refreshValues(refreshURL,targetDiv);
        }
    }

    let submitSection = document.getElementById("addsection");
    submitSection.addEventListener('click', () =>{
      create(1);
    });

    let submitLocation = document.getElementById("addlocation");
    submitLocation.addEventListener('click', () =>{
      create(2);
    });

    let submitShift = document.getElementById("addshift");
    submitShift.addEventListener('click', () =>{
      create(3);
    });

    //-------------------------refresh list of sections/locations created------------------------
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


  

    //---------------------------refresh calendar location options---------------------------------
  
      function DynamicForm3(sectionIdTag, locationOptionsTag) {
        let sectionId = document.querySelector(sectionIdTag).value
        let options = document.getElementById(locationOptionsTag);
        token = document.querySelector('meta[name="csrf-token"]').content;
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

    //---------------Calendar definition statement-------------------------------
    var calendarEl = document.getElementById('calendar');
            
    var calendar = new FullCalendar.Calendar(calendarEl, {
      allDaySlot: false,
      initialView: 'list',
      initialDate: '2023-06-02',
      duration: {days: 3},
      headerToolbar: {
        left: 'prev next',
        center: 'title',
        right: 'list,timeGrid,timeGridDay'
      }
    });

    document.addEventListener('DOMContentLoaded', function() {
      calendar.render();
    });



      //--------load the calendar--------------------------------------------------
      function DynamicForm4() {

        calendar.removeAllEvents();
        let sectionId = document.querySelector('#locationoptions').value
        if(sectionId == ""){
          sectionId=0;
        }
        token = document.querySelector('meta[name="csrf-token"]').content;
        var xhttp = new XMLHttpRequest();
        xhttp.open("get", "/findshifts/" + sectionId, true);
        xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
        xhttp.send();
        xhttp.onload = function(){
          let obj = JSON.parse(xhttp.response)
          for(var i = 0; i < obj.length; i++){
            //call database on page load and render these with correct values in loop
            calendar.addEvent({
              title: `${String(obj[i].current)} out of ${String(obj[i].max)}`,
              start: String(obj[i].start),
              end: String(obj[i].end)});
          }

          calendar.render();
        }
      }

      //event listner binds search actions
      document.getElementById("sectionId2").addEventListener("click", ()=>{
        DynamicForm3('#sectionId2','locationoptions');
      });
      document.getElementById("locationoptions").addEventListener("change", DynamicForm4);

      //reuse Dynamic form 3 for shift creation form
      document.getElementById("sectionId3").addEventListener("click", ()=>{
        DynamicForm3('#sectionId3','locationoptions2');
      });
  </script>

@endsection
