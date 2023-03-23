@extends('layouts.volunteer')

@section('content')
<style>
.dark-mode {
  background-color: black;
  color: white;
}
</style>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h2 class="h2"><span class="fw-bold">Volunteer : </span>{{ Auth::user()->first_name }}</h2>
    </div>
    
    <div class="container mt-5">
    <h2 id="message">Riverbend Map</h2>
    <button onclick="DarkFunction()">Dark Mode</button>

    <!-- Dropdown for map change -->
    <div class="dropdown">
      <button onclick="Dropping()" class="btn btn-secondary dropdown-toggle" type="button">Directions</button>
      <ul id="Dropdown" class="dropdown-menu">
        <li><input type="text" placeholder="Search" id="myInput" onkeyup="SearchFilter()"></li>
        <li><a class="dropdown-item" href="map">Map</a></li>
            <li class= "dropdown dropend"><a class="dropdown-item dropdown-toggle" href="#">Access points </a>
              <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Main Entrance</a></li>
                  <li><a class="dropdown-item" href="#">Marina Entrance</a></li>
                  <li><a class="dropdown-item" href="#">VIP Coke Stage</a></li>
                  <li><a class="dropdown-item" href="#">VIP Bud Stage</a></li>
                  <li><a class="dropdown-item" href="#">VIP Pier</a></li>
                  <li><a class="dropdown-item" href="#">Skybox</a></li>
              </ul>
            </li>
            <li class= "dropdown dropend"><a class="dropdown-item  dropdown-toggle" href="#">Credential Checkers</a>
              <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Power Alley Gate</a></li>
                  <li><a class="dropdown-item" href="#">Southern Belle Entrance</a></li>
                  <li><a class="dropdown-item" href="#">Boneyard Gate</a></li>
              </ul>
            </li>
        </li>
      </ul>
    </div>

    <!-- Map -->
    <div class="text-center">
        <img src="https://www.wdef.com/content/uploads/2022/04/q/q/riverbend-map.png" alt="Responsive image" class="img-fluid">
    </div>
    

   




<script>
// When the user clicks on the button, toggle between hiding and showing the dropdown content
function Dropping() {
  document.getElementById("Dropdown").classList.toggle("show");
}

// When user clicks the button, a seach bar displays so they are able to filter results
function SearchFilter() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("Dropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}

//when button is clicked, the page is transferred into dark mode
function DarkFunction() {
   var element = document.body;
   element.classList.toggle("dark-mode");
}

let dropdowns = document.querySelectorAll('.dropdown-toggle')
dropdowns.forEach((dd)=>{
    dd.addEventListener('click', function (e) {
        var el = this.nextElementSibling
        el.style.display = el.style.display==='block'?'none':'block'
        once:True;
    })
})
</script>
  </main>

  @prepend('js')
    @vite(['resources/js/adminhome.js'])   
  @endprepend
  

@endsection