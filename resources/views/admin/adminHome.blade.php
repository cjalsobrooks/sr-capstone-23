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

    <h2>Edit Users</h2>
    <div class="table-responsive" id="inner-height">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Admin</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
         @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->is_admin}}</td>
                <td><a style="text-decoration: none;" href="{{ route('permissions', $user->id)}}">Edit</a></td>
                <td><a style="text-decoration: none;" href="#">Delete</a></td>
            </tr>
         @endforeach
        </tbody>
      </table>
    </div>
  </main>
@endsection
