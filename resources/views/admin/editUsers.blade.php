@extends('layouts.admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2"><span class="fw-bold">Admin : </span>{{ Auth::user()->first_name }}</h1>
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

    <h2>Edit Users</h2>

    <form id="usereditsearch" class="needs-validation" novalidate="" action="javascript:void(0);" method="">
      <div class="row g-3">
        <div class="col-sm-6">
          <label for="finduser2" class="form-label">Search by last name
          </label>
          <input name="finduser2" type="text" class="form-control" id="finduser2"  required="">
        </div>
      @csrf <!-- {{ csrf_field() }} -->
    </form>
    <div class="table-responsive" id="inner-height">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Admin</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody id="responsivebody">
         @foreach ($users as $user)
            <tr>
                <td id="1">{{$user->id}}</td>
                <td id="2">{{$user->first_name}}</td>
                <td id="2">{{$user->last_name}}</td>
                <td id="3">{{$user->email}}</td>
                <td id="4">{{$user->is_admin}}</td>
                <td id="5"><a style="text-decoration: none;" href="{{route('permissions', $user->id)}}">Edit</a></td>
                <td id="6"><a style="text-decoration: none;" href="#">Delete</a></td>
            </tr>
         @endforeach
        </tbody>
      </table>
    </div>
  </main>

  @prepend('js')
    @vite(['resources/js/editusers.js'])   
  @endprepend
  
@endsection
