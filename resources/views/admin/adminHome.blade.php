@extends('layouts.admin')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">{{ Auth::user()->name }}</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
          <span data-feather="calendar" class="align-text-bottom"></span>
          This week
        </button>
      </div>
    </div>

  </main>

  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button type="button" class="btn btn-sm btn-outline-secondary">Notify All</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Notify Individual</button>
        </div>
      </div>
    </div>
    <form id="emailform" class="needs-validation" novalidate="" action="" method="POST">
      <h4></h4>
      <div class="row g-3">
        <div class="col-sm-6">
          <label for="finduser" class="form-label">Find User
          </label>
          <input name="finduser" type="text" class="form-control" id="finduser"  required="">
          <div class="invalid-feedback">
            Valid first name is required.
          </div>
        </div>
        <div class="col-sm-6">
          <label for="userselect" class="form-label">Names</label>
          <div class="input-group has-validation">
            <select class="form-control" id="userselect" name="userselect">
            </select>
          <div class="invalid-feedback">
              Your username is required.
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <label for="emailselect" class="form-label">Email Address</label>
          <div class="input-group has-validation">
            <span class="input-group-text">@</span>
            <input class="form-control" id="emailselect" name="emailselect">
          <div class="invalid-feedback">
              Your username is required.
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <label for="firstName" class="form-label">Message
          </label>
          <textarea name="name" type="text" class="form-control" id="firstName" placeholder="" value="" required=""></textarea>
          <div class="invalid-feedback">
            Valid first name is required.
          </div>
        </div>
      </div>
      <hr class="my-4">
      <button id="sendemail" class="w-25 btn btn-primary btn-lg">Emails: don't press yet</button>
      @csrf <!-- {{ csrf_field() }} -->
    </form>

<!-----------------------scripts----------------------------------------------------------->
  <script>

      //-------------button triggers email event-------------------------
      function SendMail() {
        token = document.querySelector('meta[name="csrf-token"]').content;
        var xhttp = new XMLHttpRequest();
        xhttp.open("get", "/testmail", false);
        xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
        xhttp.send();

        if(xhttp.readyState == 4){
          console.log("success")  
        }else{
          console.log(xhttp.response)
        }
      }
      document.getElementById("sendemail").addEventListener("click", SendMail, false);

      //-----------Find user emails javascript logic---------------------
      let currently_visible = [];

      function DynamicForm() {
        let data = document.forms.emailform;
        let name = data['finduser'].value;
        let options = document.getElementById("userselect");
        while (options.firstChild) {
            options.removeChild(options.firstChild);
        }
        currently_visible.length = 0;
        
        if(name.length > 0){
            //request for emails from server
            console.log(name);
            token = document.querySelector('meta[name="csrf-token"]').content;
            var xhttp = new XMLHttpRequest();
            xhttp.open("get", "/findemail/" + name, false);
            xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
            xhttp.send();

            if(xhttp.readyState == 4){
              let obj = JSON.parse(xhttp.response)
              for (i = 0; i < obj.length; i++) {
                    let node = document.createElement("option");
                    node.value = String(obj[i].name);
                    node.innerHTML = String(obj[i].name);
                    options.appendChild(node);
                    currently_visible[String(obj[i].name)] = String(obj[i].email);
              }
            }
        }
      }
      function findEmail() {
        let data = document.forms.emailform;
        var name = data['userselect'].value;
        if (currently_visible[name] !== undefined) {
            document.getElementById("emailselect").value = currently_visible[name];
        }
      }
      
      document.getElementById("userselect").addEventListener("click", findEmail, true);
      document.getElementById("finduser").addEventListener("keyup", DynamicForm, true);

  </script>
@endsection
