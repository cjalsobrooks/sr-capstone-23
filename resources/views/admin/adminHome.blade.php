@extends('layouts.admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2"> Admin : <span class="text-muted" style="font-family:nunito;">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span></h2>
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
          <textarea name="messageuser" type="text" class="form-control" id="messageuser" placeholder="" value="" required=""></textarea>
        </div>
      </div>
      <button id="sendemail" type="button" class="btn btn-success mt-4">Emails: don't press yet</button>

      @csrf <!-- {{ csrf_field() }} -->
    </form>

    <form style="display:none;" id="emailform2" class="needs-validation" novalidate="" action="javascript:void(0)" method="">
      <h4>Email All</h4>
      <div class="row g-3">
        <div class="col-sm-12">
          <label for="firstName" class="form-label">Message
          </label>
          <textarea name="messageall" type="text" class="form-control" id="messageall" placeholder="" value="" required=""></textarea>
        </div>
      </div>
      <button id="sendemail2" type="button" class="btn btn-success mt-4">Emails: don't press yet</button>
      @csrf <!-- {{ csrf_field() }} -->
    </form>

  </main>

  @prepend('js')
    @vite(['resources/js/adminhome.js'])   
  @endprepend
  

@endsection
