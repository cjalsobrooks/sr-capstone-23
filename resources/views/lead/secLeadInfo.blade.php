@extends('layouts.volunteer')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h2 class="h2"><span class="fw-bold">Section: </span>section name here</h2>
      <h2 class="h2"><span class="fw-bold">Lead: </span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>      
    </div>
    
    <div class="container mt-5">
      <h2 id="message">other section info down here</h2>
    </div>
  </main>

  @prepend('js')
    @vite(['resources/js/sectionlead.js'])   
  @endprepend
  

@endsection