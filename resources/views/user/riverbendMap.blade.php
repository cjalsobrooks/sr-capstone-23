@extends(Auth::user()->is_admin ? 'layouts.admin' : 'layouts.volunteer')

@section('content')
<style>
.dark-mode {
  background-color: black;
  color: white;
}

* {box-sizing: border-box;}

.img-magnifier-container {
  position: relative;
}

.img-magnifier-glass {
  position: absolute;
  border: 3px solid #000;
  border-radius: 50%;
  cursor: none;
  /*Set the size of the magnifier glass:*/
  width: 80px;
  height: 80px;
}
</style>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h2 class="h2"><span class="fw-bold">Volunteer : </span><span class="text-muted" style="font-family:nunito;">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span></h2>
    </div>
    
    <div class="container mt-5">
    <h2 id="message">Riverbend Map</h2>
    <button id="DarkMode">Dark Mode</button>

    <!-- Dropdown for map change -->
    <div class="dropdown">
      <button onhover="Dropping()" class="btn btn-secondary dropdown-toggle" type="button">Directions</button>
      <ul id="Dropdown" class="dropdown-menu">
        <li><button id="Map" class="dropdown-item">Map</button></li>
            <li class= "dropdown dropend"><button class="dropdown-item dropdown-toggle">Access points</button>
              <ul class="dropdown-menu">
                  <li><button id = "MaiEnt" class="dropdown-item">Main Entrance</button></li>
                  <li><button id ="MarEnt"  class="dropdown-item">Marina Entrance</button></li>
                  <li><button id ="Coke"  class="dropdown-item">VIP Coke Stage</button></li>
                  <li><button id ="Bud"  class="dropdown-item">VIP Bud Stage</button></li>
                  <li><button id ="Pier"  class="dropdown-item">VIP Pier</button></li>
                  <li><button id ="Skybox"  class="dropdown-item" >Skybox</button</li>
              </ul>
            </li>
            <li class= "dropdown dropend"><a class="dropdown-item  dropdown-toggle" href="#">Credential Checkers</a>
              <ul class="dropdown-menu">
                  <li><button id ="PAGate" class="dropdown-item" >Power Alley Gate</button></li>
                  <li><button id ="SBEnt" class="dropdown-item" >Southern Belle Entrance</button></li>
                  <li><button id ="BoneGate" class="dropdown-item" >Boneyard Gate</button></li>
              </ul>
            </li>
        </li>
      </ul>
    </div>

    <!-- Map -->
    <div class="text-center">
        <img src="https://www.wdef.com/content/uploads/2022/04/q/q/riverbend-map.png" id="image" class="img-fluid">
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

//Checks for a button click
document.querySelectorAll('button').forEach(occurence => {
  let id = occurence.getAttribute('id');
  occurence.addEventListener('click', function() {
    if(id=="DarkMode"){//if button with id "DarkMode" is hit, it changes the page CSS to the style above labeled "dark mode"
      var element = document.body;
      element.classList.toggle("dark-mode");
    }
    if(id == "Map"){//if button with id "Map" is hit, it changes the picture to the link given.
      document.getElementById("image").src = "https://www.wdef.com/content/uploads/2022/04/q/q/riverbend-map.png";
    }
    if(id == "MarEnt"){//if button with id "MarEnt" is hit, it changes the picture to the link given.
      document.getElementById("image").src="/Images/MarinaEntrance.png";
    }
    if(id == "MaiEnt"){//if button with id "MaiEnt" is hit, it changes the picture to the link given.
      document.getElementById("image").src="/Images/MainEntrance.png";
    }
    if(id == "Coke"){//if button with id "Coke" is hit, it changes the picture to the link given.
      document.getElementById("image").src="/Images/VIPCokeStage.png";
    }
    if(id == "Bud"){//if button with id "Bud" is hit, it changes the picture to the link given.
      document.getElementById("image").src="/Images/VIPBudStage.png";
    }
    if(id == "Pier"){//if button with id "Pier" is hit, it changes the picture to the link given.
      document.getElementById("image").src="/Images/Pier.png";
    }
    if(id == "Skybox"){//if button with id "Skybox" is hit, it changes the picture to the link given.
      document.getElementById("image").src="/Images/Skybox.png";
    }
    if(id == "PAGate"){//if button with id "Skybox" is hit, it changes the picture to the link given.
      document.getElementById("image").src="/Images/PowerAlley.png";
    }
    if(id == "SBEnt"){//if button with id "Skybox" is hit, it changes the picture to the link given.
      document.getElementById("image").src="/Images/SouthernBelleEntrance.png";
    }
    if(id == "BoneGate"){//if button with id "Skybox" is hit, it changes the picture to the link given.
      document.getElementById("image").src="/Images/BoneGate.png";
    }
  } );
});

// dropdowns so the menu works correctly and listens for the click so the dropdown happens
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