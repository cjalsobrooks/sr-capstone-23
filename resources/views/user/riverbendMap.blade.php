@extends('layouts.volunteer')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h2 class="h2"><span class="fw-bold">Volunteer : </span>{{ Auth::user()->first_name }}</h2>
    </div>
    
    <div class="container mt-5">
    <h2 id="message">Riverbend Map</h2>
    <div class="text-center">
        <img src="https://www.wdef.com/content/uploads/2022/04/q/q/riverbend-map.png" alt="image" class="img-fluid" style="height: 700px; width: 1000px;">
    </div>
  </main>

  @prepend('js')
    @vite(['resources/js/adminhome.js'])   
  @endprepend
  

@endsection