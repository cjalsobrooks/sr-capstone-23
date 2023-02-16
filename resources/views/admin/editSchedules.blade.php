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
      <form id="emailform" class="needs-validation" novalidate="" action="" method="POST">
        <h4>Choose section leader</h4>
        <div class="row g-3">
          <div class="col-sm-6">
            <label for="finduser" class="form-label">Volunteers by last name
            </label>
            <input name="finduser" type="text" class="form-control" id="finduser"  required="">
          </div>
          <div class="col-sm-6">
            <label for="userselect" class="form-label">Name</label>
            <div class="input-group has-validation">
              <select class="form-control" id="userselect" name="userselect">
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <h4>Section Name</h4>
            <input name="finduser" type="text" class="form-control" id="finduser"  required="">
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


    <div id="location" style="display:none;" class="createoptions">
      <h2 class="fw-bold my-3">Add Location</h2>
      <form id="emailform" class="needs-validation" novalidate="" action="" method="POST">
        <div class="row g-3">
          
          <div class="col-sm-6">
            <h4>Choose section leader</h4>
            <div class="input-group has-validation">
              <select class="form-control" id="userselect" name="userselect">
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <h4>Section Name</h4>
            <input name="finduser" type="text" class="form-control" id="finduser"  required="">
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
  </div>

  <div id="shift" style="display:none;" class="createoptions">
      <h2 class="fw-bold my-3">Add Shift</h2>
      <form id="emailform" class="needs-validation" novalidate="" action="" method="POST">
        <div class="row g-3">
          <div class="col-sm-6">
            <h4>Choose section leader</h4>
            <div class="input-group has-validation">
              <select class="form-control" id="userselect" name="userselect">
              </select>
            </div>
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
            <h4>Start Time</h4>
            <input name="finduser" type="text" class="form-control" id="finduser"  required="">
          </div>
          <div class="col-sm-6">
            <h4>End Time</h4>
            <input name="finduser" type="text" class="form-control" id="finduser"  required="">
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
      //ternary toggle
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
  </script>

@endsection
