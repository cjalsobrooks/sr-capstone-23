@extends('layouts.admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h2 class="h2"> Admin : <span class="text-muted" style="font-family:nunito;">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span></h2>
    </div>
    <div id="responsivebody">
      @include('partial.displaysingleshift')
    </div>
    <form>
        <input type="hidden" id="shiftId-hidden" name="volId-hidden" value="{{$volunteers[0]->shift_id}}">
    </form>
</main>
<script>
  //---------------Unregister Ajax action-------------------------------------
  let staticElement = document.getElementById('responsivebody');
   staticElement.addEventListener('click', (evt)=>{
     const link = evt.target.closest(".unregister")
     Unregister(link.dataset.value);
   });
   
   function Unregister(link){
      var xhttp = new XMLHttpRequest();
      xhttp.open("get", link, true);
      xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
      xhttp.send();
      xhttp.onload = function(){
        alert(xhttp.response);
        refreshValues('/refreshsingleshift/' + document.querySelector("#shiftId-hidden").value, 'responsivebody');
      }
   }

</script>
  @prepend('js')

  @endprepend
@endsection