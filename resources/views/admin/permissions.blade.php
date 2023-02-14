@extends('layouts.admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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
    <form class="needs-validation" novalidate="" action="{{route('editpermissions', $user->id)}}" method="POST">
      <h4>Editing: {{$user->first_name}} {{$user->last_name}}</h4>
      <div class="row g-3">
        <div class="col-sm-6">
          <label for="firstName" class="form-label">First Name</label>
          <input name="firstName" type="text" class="form-control" id="firstName" placeholder="" value="{{$user->first_name}}" required="">
          <div class="invalid-feedback">
            Valid first name is required.
          </div>
        </div>
        
        <div class="col-sm-6">
          <label for="lastName" class="form-label">Last Name</label>
          <input name="lastName" type="text" class="form-control" id="lastName" placeholder="" value="{{$user->last_name}}" required="">
          <div class="invalid-feedback">
            Valid first name is required.
          </div>
        </div>

        <div class="col-sm-6">
          <label for="admin" class="form-label">Admin Status</label>
          @if($user->is_admin == 0)         
            <div class="form-check">
              <input name="is_admin" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
                false
              </label>
            </div>  
          @else
            <div class="form-check">
              <input name="is_admin" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" checked>
              <label class="form-check-label" for="flexCheckChecked">
                true
              </label>
            </div>       
          @endif
        </div>

        <div class="col-12">
          <label for="username" class="form-label">Email Address</label>
          <div class="input-group has-validation">
            <span class="input-group-text">@</span>
            <input name="email" type="text" class="form-control" id="username" placeholder="Username" value="{{$user->email}}" required="">
          <div class="invalid-feedback">
              Your username is required.
            </div>
          </div>
        </div>

      <hr class="my-4">
      @csrf <!-- {{ csrf_field() }} -->
      <button class="w-25 btn btn-primary btn-lg" type="submit">update</button>
    </form>
  </main>
@endsection
