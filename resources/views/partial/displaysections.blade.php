
  @foreach ($sections as $section)
    <a href="#" class="list-group-item list-group-item-action py-3 lh-tight" aria-current="true">
      <div class="d-flex align-items-center justify-content-between">
        <strong class="mb-1">{{$section->name}}</strong>
        <small><span class="fw-bold">Section Lead:</span>   {{$section->first_name}} {{$section->last_name}}</small>
      </div>
      <div class="col-10 mb-1 small">{{$section->description}}</div>
    </a>
  @endforeach

