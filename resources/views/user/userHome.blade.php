@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <title>Volunteer Dashboard</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Volunteer Dashboard</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#schedule">Schedule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#message">Message Supervisor</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#message">Riverbend Map</a>
          </li>
        </ul>
      </div>
    </nav>

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

      <h2 id="message">Message Supervisor</h2>
      <form>
        <div class="form-group">
          <label for="subject">Subject</label>
          <input type="text" class="form-control" id="subject" />
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea class="form-control" id="message" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

      <h2 id="message">Riverbend Map</h2>
    <div class="text-center">
        <img src="https://www.wdef.com/content/uploads/2022/04/q/q/riverbend-map.png" alt="image" class="img-fluid" style="height: 700px; width: 1000px;">
    </div>
    
    </div>

    

    <script
      src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"
    ></script>
    <script
      src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    ></script>
  </body>
</html>


@endsection

