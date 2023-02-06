@extends('layouts.admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">{{ Auth::user()->name }}</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button type="button" class="btn btn-sm btn-outline-secondary">button 1</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">button 2</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
          <span data-feather="calendar" class="align-text-bottom"></span>
          This week
        </button>
      </div>
    </div>
    <button id="sendemail" class="w-25 btn btn-primary btn-lg">Emails: don't press yet</button>
  </main>
  <script>
      function SendMail() {
        token = document.querySelector('meta[name="csrf-token"]').content;
        var xhttp = new XMLHttpRequest();
        xhttp.open("get", "/testmail", false);
        xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
        xhttp.send();

        if(xhttp.readyState == 4 && xhttp.response == 200){
          console.log("success")  
        }else{
          console.log(xhttp.response)
        }
      }
      document.getElementById("sendemail").addEventListener("click", SendMail, false);
  </script>
@endsection
