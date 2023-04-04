@extends('layouts.admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h2 class="h2"> Admin : <span class="text-muted" style="font-family:nunito;">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span></h2>
    </div>

    <h4>Edit Users</h4>
    <form id="usereditsearch" class="needs-validation" novalidate="" action="javascript:void(0);" method="">
      <div class="row g-3">
        <div class="col-sm-6">
          <label for="finduser2" class="form-label">Users by last name
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
            <th scope="col">Admin</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody id="responsivebody" class="shadow-sm">
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
