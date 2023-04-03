@extends('layouts.user')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
      <h2 class="h2"><span class="fw-bold">Volunteer : </span>{{ Auth::user()->first_name }}</h2>
    </div>

    <h4>Your Group</h4>

    <table class="table">
        <thead>
            <tr>
                <th>Volunteer ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($vols as $vol)
            <tr>
                <td>{{$vol->id}}</td>
                <td>{{$vol->first_name}}</td>
                <td>{{$vol->last_name}}</td>
                <td><a style="text-decoration: none;" href="#" class="edit-volunteer" data-id="{{$vol->id}}">Edit</a></td>
                <td><a style="text-decoration: none;" href="#">Delete</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

  @prepend('js')
    <script>
        const permissionsUrl = "{{ route('permissions', ['id' => Auth::user()->id]) }}";
    </script>
    @vite(['resources/js/viewGroup.js'])   
  @endprepend
  
@endsection
