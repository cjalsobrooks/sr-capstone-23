@extends('layouts.admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h2 class="h2"><span class="fw-bold">Admin : </span>{{ Auth::user()->first_name }}</h2>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
        <button id="showedit" type="button" class="btn btn-sm btn-outline-secondary">Edit Schedule</button>
        <button id="showcreate" type="button" class="btn btn-sm btn-outline-secondary">Create Section</button>
      </div>
    </div>
  </div>



  <div class="toggleedit">
    <form id="usereditsearch" class="needs-validation" novalidate="" action="javascript:void(0);" method="">
      <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>

      <h4 class="mt-10">Edit Schedules</h4>
      <div class="row g-3">
        <div class="col-sm-6">
          <label for="finduser2" class="form-label">Volunteers by last name
          </label>
          <input name="finduser2" type="text" class="form-control" id="finduser2"  required="">
        </div>
      @csrf <!-- {{ csrf_field() }} -->
      </div>
    </form>
    <div class="table-responsive mt-4" id="inner-height">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="responsivebody">
         @foreach ($users as $user)
            <tr>
                <td id="1">{{$user->id}}</td>
                <td id="2">{{$user->first_name}}</td>
                <td id="3">{{$user->last_name}}</td>
                <td id="4">{{$user->email}}</td>
                <td id="6"><a style="text-decoration: none;" href="{{route('permissions', $user->id)}}">Edit</a></td>
            </tr>
         @endforeach
        </tbody>
      </table>
    </div>
  </div>


  <div style="display:none;" id="togglecreate">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
      <div></div>
      <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar align-text-bottom" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        Options
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

        <div class="list-group list-group-flush border-bottom scrollarea">
          @foreach ($sections as $section)
          <a href="#" class="list-group-item list-group-item-action py-3 lh-tight" aria-current="true">
            <div class="d-flex align-items-center justify-content-between">
              <strong class="mb-1">{{$section->name}}</strong>
              <small>{{$section->first_name}} {{$section->last_name}}</small>
            </div>
            <div class="col-10 mb-1 small">{{$section->description}}</div>
          </a>
          @endforeach
        </div>
      </div>
    </div>


    <div id="location" style="display:none;" class="createoptions">
      <h2 class="fw-bold my-3">Add Location</h2>
      <form id="" class="needs-validation" novalidate="" action="" method="POST">
        <div class="row g-3">
          <div class="col-sm-6">
            <h4>Choose Section</h4>
            <input name="" type="text" class="form-control" id=""  required="">
          </div>
          <div class="col-sm-6">

          </div>
          <div class="col-sm-6">
            <h4>Location Name</h4>
            <div class="input-group has-validation">
              <select class="form-control" id="userselect" name="userselect">
              </select>
            </div>
          </div>
          <div class="col-sm-12">
            <h4>Description</h4>
            <textarea name="name" type="text" class="form-control" id="firstName" placeholder="" value="" required=""></textarea>
          </div>
        </div>
        @csrf <!-- {{ csrf_field() }} -->
      </form>
      <button id="sendemail" type="button" class="btn btn-success mt-4">Submit</button>
    </div>

  <div id="shift" style="display:none;" class="createoptions">
      <h2 class="fw-bold my-3">Add Shift</h2>
      <form id="emailform" class="needs-validation" novalidate="" action="" method="POST">
        <div class="row g-3">
          <div class="col-sm-6">
            <h4>Choose Location</h4>
            <div class="input-group has-validation">
              <select class="form-control" id="userselect" name="userselect">
              </select>
            </div>
          </div>
          <div class="col-sm-6">

          </div>

          <div class="col-sm-6">
            <h4>Shift Name</h4>
            <input name="finduser" type="text" class="form-control" id="finduser"  required="">
          </div>
          <div class="col-sm-12">
            <h4>Description</h4>
            <textarea name="name" type="text" class="form-control" id="firstName" placeholder="" value="" required=""></textarea>
          </div>
          <div class="col-sm-6">
            <h4>Day</h4>
            <input name="finduser" type="date" class="form-control" id="finduser"  required="">
          </div>
        <div class="col-sm-6"></div>
          <div class="col-sm-6">
            <h4>Start Time</h4>
            <input name="finduser" type="time" class="form-control" id="finduser"  required="">
          </div>
          <div class="col-sm-6">
            <h4>End Time</h4>
            <input name="finduser" type="time" class="form-control" id="finduser"  required="">
          </div>
        </div>
        @csrf <!-- {{ csrf_field() }} -->
      </form>
      <button id="sendemail" type="button" class="btn btn-success mt-4">Submit</button>
    </div>
  </div>
  <div class="row pt-4 toggleedit"> 
    <h2 class="h2"><span class="fw-bold">Schedule : </span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
    <div style="max-height: 500px;" class="col-12 mt-4 toggleedit" id='calendar'></div>
  </div>
  </main>
  
  @prepend('js')
    @vite(['resources/js/editschedules.js'])  
  @endprepend

  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
  <script>
      function toggleDiv(inner) {
      let selected = ''
      var buttons = document.getElementsByClassName("createoptionstoggle");
      switch(String(inner)) {
        case "Add Section":
          selected = 'section'
          break;
        case "Add Location":
          selected = 'location'
          break;
        case "Add Shift":
          selected = 'shift'
          break;
      }

      var divs = document.getElementsByClassName("createoptions");
      for(var i = 0; i < divs.length; i++){
          divs[i].style.display = "none";    
      }
      document.getElementById(selected).style.display = "block"
    }


      var elements = document.getElementsByClassName("createoptionstoggle");
      Array.from(elements).forEach(function(element) {
        element.addEventListener('click', () =>{
          toggleDiv(element.innerText);
        });
      });






      //-------------------------------------------------------------
      function createsection() {
        // Form fields, see IDs above
        const params = {
            volId: document.querySelector('#volId').value,
            sectionName: document.querySelector('#section-name').value,
            sectionDescription: document.querySelector('#section-description').value
        }

        const xhttp = new XMLHttpRequest()
        xhttp.open('POST', '/createsection')
        xhttp.setRequestHeader("X-CSRF-TOKEN", token); 
        xhttp.setRequestHeader('Content-type', 'application/json')
        xhttp.send(JSON.stringify(params))
        xhttp.onload = function() {
            alert(xhttp.responseText)
        }
    }

    let submitSection = document.getElementById("addsection");
    submitSection.addEventListener('click', createsection);

  </script>

@endsection
