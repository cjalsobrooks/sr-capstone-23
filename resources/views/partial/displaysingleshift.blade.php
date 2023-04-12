<div class="d-flex  pt-3">
  <p style="font-size:100%;" class="w-100 pb-3 mb-0 small lh-sm border-bottom">
    <strong class="d-block text-gray-dark">{{$volunteers[0]->section_name}} </strong>
    <span class="mt-2 d-block"> {{$volunteers[0]->location_name}} </span>
    <span class="mt-2 d-block">Section Lead: <strong>{{$section_lead->first_name}} {{$section_lead->last_name}}</strong> &nbsp&nbsp&nbsp Shift Name: <strong>{{$volunteers[0]->shift_name}}</strong> &nbsp&nbsp&nbsp Start Time: <strong>{{date('h:i:s a m/d/Y', strtotime(strval($volunteers[0]->start_time)))}}</strong></span>
  </p>
</div>
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
        @if($volunteers[0]->exists == 1)
          @foreach ($volunteers as $volunteer)
              <tr>
                  <td id="2">{{$volunteer->first_name}}</td>
                  <td id="2">{{$volunteer->last_name}}</td>
                  <td id="6"><a class="unregister" style="text-decoration: none;" data-value="/unregistervol/{{$volunteer->shift_id}}/{{$volunteer->id}}" href="javascript:void(0)">Unassign</a></td>
              </tr>
          @endforeach
        @endif
        </tbody>
      </table>

    </div>