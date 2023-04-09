@extends('layouts.admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h2 class="h2"> Admin : <span class="text-muted" style="font-family:nunito;">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span></h2>
    </div>

    <h4>Edit Shift <br><span style="font-family:nunito; font-size:75%; line-height:40px;">{{$volunteers[0]->section_name}} <span style="font-size:150%" class="fw-bold">/</span> {{$volunteers[0]->location_name}} <span style="font-size:150%" class="fw-bold">/</span> {{date('h:i:s a m/d/Y', strtotime(strval($volunteers[0]->start_time)))}}</span></h4>
    <div class="table-responsive mt-4" id="inner-height">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody id="responsivebody" class="shadow-sm">
         @foreach ($volunteers as $volunteer)
            <tr>
                <td id="2">{{$volunteer->first_name}}</td>
                <td id="2">{{$volunteer->last_name}}</td>
                <td id="6"><a style="text-decoration: none;" href="#">Unassign</a></td>
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