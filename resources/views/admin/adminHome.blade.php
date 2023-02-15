@extends('layouts.admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2"><span class="fw-bold">Admin : </span>{{ Auth::user()->first_name }}</h1>
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
          <label for="finduser" class="form-label">Search by last name
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

  @prepend('js')
    @vite(['resources/js/adminhome.js'])   
  @endprepend
  
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>

@endsection
