@extends('layouts.user')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
      <h2 class="h2"><span class="fw-bold">Volunteer : </span>{{ Auth::user()->first_name }}</h2>
    </div>

    <h4>Your Group</h4>
    <!-- 
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
        <tbody id="responsivebody">
        @php
          $vols = json_decode(file_get_contents(route('findGroupByID', ['id' => Auth::user()->id])));
        @endphp

         @foreach ($vols as $vol)
            <tr>
                <td id="1">{{$vol->id}}</td>
                <td id="2">{{$vol->first_name}}</td>
                <td id="3">{{$vol->last_name}}</td>
                <td id="4"><a style="text-decoration: none;" href="{{route('permissions', $user->id)}}">Edit</a></td>
                <td id="5"><a style="text-decoration: none;" href="#">Delete</a></td>
            </tr>
         @endforeach
        </tbody>
      </table>
    </div>
  </main>
 -->
  @prepend('js')
    @vite(['resources/js/viewGroup.js'])   
  @endprepend
  
@endsection
