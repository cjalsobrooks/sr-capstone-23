
  @foreach ($locations as $location)
    <a href="#" class="list-group-item list-group-item-action py-3 lh-tight" aria-current="true">
      <div class="d-flex align-items-center justify-content-between">
        <strong class="mb-1">{{$location->name}}</strong>
        <small><span class="fw-bold">Section:</span>{{$location->section}}</small>
      </div>
      <div class="col-10 mb-1 small">{{$location->description}}</div>
    </a>
  @endforeach
