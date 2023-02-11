@extends('layouts.admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2"><span class="fw-bold">Admin : </span>{{ Auth::user()->name }}</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
          <span data-feather="calendar" class="align-text-bottom"></span>
          This week
        </button>
      </div>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button id="showall" type="button" class="btn btn-sm btn-outline-secondary">All</button>
          <button id="showone" type="button" class="btn btn-sm btn-outline-secondary">One</button>
        </div>
      </div>
    </div>
    
    <form id="emailform" class="needs-validation" novalidate="" action="" method="POST">
      <h4>Email Individual</h4>
      <div class="row g-3">
        <div class="col-sm-6">
          <label for="finduser" class="form-label">Find User
          </label>
          <input name="finduser" type="text" class="form-control" id="finduser"  required="">
        </div>
        <div class="col-sm-6">
          <label for="userselect" class="form-label">Names</label>
          <div class="input-group has-validation">
            <select class="form-control" id="userselect" name="userselect">
            </select>
          </div>
        </div>
        <div class="col-sm-6">
          <label for="emailselect" class="form-label">Email Address</label>
          <div class="input-group has-validation">
            <span class="input-group-text">@</span>
            <input class="form-control" id="emailselect" name="emailselect">

          </div>
        </div>
        <div class="col-sm-12">
          <label for="firstName" class="form-label">Message
          </label>
          <textarea name="name" type="text" class="form-control" id="firstName" placeholder="" value="" required=""></textarea>
        </div>
      </div>
      
      <button id="sendemail" class="w-25 mt-4 btn btn-primary btn-lg">Emails: don't press yet</button>
      @csrf <!-- {{ csrf_field() }} -->
    </form>

    <form style="display:none;" id="emailform2" class="needs-validation" novalidate="" action="" method="POST">
      <h4>Email All</h4>
      <div class="row g-3">
        <div class="col-sm-12">
          <label for="firstName" class="form-label">Message
          </label>
          <textarea name="name" type="text" class="form-control" id="" placeholder="" value="" required=""></textarea>
        </div>
      </div>
      <button id="sendemail" class="w-25 mt-4 btn btn-primary btn-lg">Emails: don't press yet</button>
      @csrf <!-- {{ csrf_field() }} -->
    </form>
    <hr class="my-4">
    <div class="row pt-4">
      <h2 class="fw-bold">Your Schedule</h2>
      <div class="col-12 mt-4" id='calendar'></div>
    </div>

  </main>



<!-----------------------scripts----------------------------------------------------------->
  <script>
      //-------------button triggers email event-------------------------
      function SendMail() {
        token = document.querySelector('meta[name="csrf-token"]').content;
        var xhttp = new XMLHttpRequest();
        xhttp.open("get", "/testmail", false);
        xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
        xhttp.send();

        if(xhttp.readyState == 4){
          console.log("success")  
        }else{
          console.log(xhttp.response)
        }
      }
      document.getElementById("sendemail").addEventListener("click", SendMail, false);

      //-----------Find user emails javascript logic---------------------
      let currently_visible = [];

      function DynamicForm1() {
        let data = document.forms.emailform;
        let name = data['finduser'].value;
        let options = document.getElementById("userselect");

        currently_visible.length = 0;
        
        if(name.length > 0){
            //request for emails from server
            token = document.querySelector('meta[name="csrf-token"]').content;
            var xhttp = new XMLHttpRequest();
            xhttp.open("get", "/findemail/" + name, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
            xhttp.send();
            xhttp.onreadystatechange = function(){
              while (options.firstChild) {
                options.removeChild(options.firstChild);
              }
              console.log(xhttp.response)
              let obj = JSON.parse(xhttp.response)
              for (i = 0; i < obj.length; i++) {
                let node = document.createElement("option");
                node.value = String(obj[i].name);
                node.innerHTML = String(obj[i].name);
                options.appendChild(node);
                currently_visible[String(obj[i].name)] = String(obj[i].email);
              }
            } 
        }
      }

      function delay1(callback, ms) {
          var timer = 0;
          return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
              callback.apply(context, args);
            }, ms || 0);
          };
        }


      function findEmail() {
        let data = document.forms.emailform;
        let name = data['userselect'].value;
        if (currently_visible[name] !== undefined) {
            document.getElementById("emailselect").value = currently_visible[name];
        }
      }
      
      document.getElementById("userselect").addEventListener("click", findEmail, true);
      document.getElementById("finduser").addEventListener("keyup", delay1(DynamicForm1, 500), true);

      //-------------------Form Toggling----------------------------------------------
      function toggleOne(){
        document.getElementById("emailform").style.display = 'block';
        document.getElementById("emailform2").style.display = 'none';
      }
      document.getElementById("showone").addEventListener("click", toggleOne, true);

      function toggleAll(){
        document.getElementById("emailform").style.display = 'none';
        document.getElementById("emailform2").style.display = 'block';
      }
      document.getElementById("showall").addEventListener("click", toggleAll, true);


      let test = "title";
      //-----------------Calendar Test------------------------------
      document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        initialDate: '2023-06-02',
        headerToolbar: {
          left: 'prev',
          center: 'title',
          right: 'next'
        },
        events: [
          {
            title: `${test}`,
            start: '2023-06-02T10:30:00',
            end: '2023-06-02T12:30:00'
          },
          {
            title: 'Event 2',
            start: '2023-06-02T12:30:00',
            end: '2023-06-02T16:30:00'
          },
          {
            title: 'Event 3',
            start: '2023-06-03T08:30:00',
            end: '2023-06-412:30:00'
          },
          {
            title: 'Event 4',
            start: '2023-06-03T14:30:00',
            end: '2023-06-4T17:30:00'
          }
        ]
      });

  calendar.render();
});
  </script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
@endsection
