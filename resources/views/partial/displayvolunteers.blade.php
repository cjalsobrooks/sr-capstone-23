@foreach ($volunteers as $vol)
<div class="d-flex text-muted pt-3">
  @if (in_array($vol->id, $sectionLeadIds))
    <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="https://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#e83e8c"></rect><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text></svg>
    <p class="w-100 pb-3 mb-0 small lh-sm border-bottom">
    <strong class="d-block text-gray-dark">@ {{$vol->first_name}} {{$vol->last_name}}</strong>
    <span class="mt-2 d-block">{{$vol->comment}}</span>
    <span class="mt-2 d-block">Age: <strong>{{$vol->age}}</strong> &nbsp&nbsp&nbsp Shirt-Size: <strong>{{$vol->shirt_size}}</strong> &nbsp&nbsp&nbsp <strong>Section Lead</strong> &nbsp&nbsp&nbsp <a style="text-decoration:none;" href="{{route('editvolschedule', $vol->id)}}">Edit</a></span>
  </p>
  @else
    <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="https://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
    <p class="w-100 pb-3 mb-0 small lh-sm border-bottom">
    <strong class="d-block text-gray-dark">@ {{$vol->first_name}} {{$vol->last_name}}</strong>
    <span class="mt-2 d-block">{{$vol->comment}}</span>
    <span class="mt-2 d-block">Age: <strong>{{$vol->age}}</strong> &nbsp&nbsp&nbsp Shirt-Size: <strong>{{$vol->shirt_size}}</strong> &nbsp&nbsp&nbsp <a style="text-decoration:none;" href="{{route('editvolschedule', $vol->id)}}">Edit</a></span>
  </p>
  @endif
</div>
@endforeach