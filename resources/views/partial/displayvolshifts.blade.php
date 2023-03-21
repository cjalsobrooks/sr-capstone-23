@foreach ($volShifts as $shift)
    <tr>
        <td id="1">{{$shift->section_name}}</td>
        <td id="2">{{$shift->location_name}}</td>
        <td id="3">{{$shift->name}}</td>
        <td id="4">{{date('h:i:s a m/d', strtotime(strval($shift->start_time)))}}</td>
        <td id="5">{{date('h:i:s a m/d', strtotime(strval($shift->end_time)))}}</td>
        <td id="5"><a class="unregister" style="text-decoration: none;" data-value="/unregistervol/{{$shift->id}}/{{$vol->id}}" href="javascript:void(0)">Unregister</a></td>
    </tr>
@endforeach