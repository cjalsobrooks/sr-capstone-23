@extends('layouts.admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<h4>Shifts Available</h4>
<table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">name</th>
            <th scope="col">start</th>
            <th scope="col">end</th>
            <th scope="col">remaining</th>
          </tr>
        </thead>
        <tbody id="responsivebody" class="shadow-sm">
         @foreach ($allShifts as $shift)
            <tr>
                <td class="fw-bold">{{$shift->name}}</td>
                <td>{{date('h:i:s a m/d', strtotime(strval($shift->start_time)))}}</td>
                <td>{{date('h:i:s a m/d', strtotime(strval($shift->end_time)))}}</td>
                <td>{{$shift->max_volunteers - $shift->current_volunteers}} spots remaining</td>
                <td><a href="#">register</a></td>
            </tr>
         @endforeach
        </tbody>
</table>
<h4>Current schedule</h4>
<table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">name</th>
            <th scope="col">start</th>
            <th scope="col">end</th>
            <th scope="col">remaining</th>
          </tr>
        </thead>
        <tbody id="responsivebody" class="shadow-sm">
         @foreach ($volShifts as $shift)
            <tr>
                <td class="fw-bold">{{$shift->name}}</td>
                <td>{{date('h:i:s a m/d', strtotime(strval($shift->start_time)))}}</td>
                <td>{{date('h:i:s a m/d', strtotime(strval($shift->end_time)))}}</td>
                <td>{{$shift->max_volunteers - $shift->current_volunteers}} spots remaining</td>
                <td><a href="#">remove</a></td>
            </tr>
         @endforeach
        </tbody>
</table>
</main>
@endsection