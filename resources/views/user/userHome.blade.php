@extends('layouts.volunteer')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h2 class="h2"><span class="fw-bold">Volunteer : </span>{{ Auth::user()->first_name }}</h2>
    </div>
    
    <div class="container mt-5">
      <h1 class="text-center">Welcome Volunteer!</h1>
      <p>
        Welcome to Riverbend! We thank you so much for volunteering with us. This dashboard will allow you to
        view your shift schedule and message your supervisor if you need anything.
      </p>

      <h2 id="schedule">Your Shift Schedule</h2>
      <table class="table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Position</th>
            <th>Shift Start Time</th>
            <th>Shift End Time</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Friday, February 10th</td>
            <td>Checkpoint</td>
            <td>9:00 AM</td>
            <td>1:00 PM</td>
          </tr>
          <tr>
            <td>Saturday, February 11th</td>
            <td>Janitorial</td>
            <td>1:00 PM</td>
            <td>5:00 PM</td>
          </tr>
          <tr>
            <td>Sunday, February 12th</td>
            <td>Security</td>
            <td>9:00 AM</td>
            <td>1:00 PM</td>
          </tr>
        </tbody>
      </table>
  </main>

  @prepend('js')
    @vite(['resources/js/adminhome.js'])   
  @endprepend
  

@endsection
