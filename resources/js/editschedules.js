      //-----------Find volunteer for edit schedule page---------------------
      function DynamicForm2() {
        let data = document.forms.voleditsearch;
        let lastname = data['findvol2'].value;
        const xhttp = new XMLHttpRequest();

        if(lastname.length == 0){
          xhttp.open('GET', '/findvolunteers2/' + 0, true);
        }else{
          xhttp.open('GET', '/findvolunteers2/' + lastname, true);
        }
       
        xhttp.setRequestHeader("X-CSRF-TOKEN", token); 
        xhttp.setRequestHeader('Content-type', 'application/json');
        xhttp.send();
        xhttp.onload = function() {
            let current = document.getElementById('target3');
            String(xhttp.responseText);
            while(current.firstChild){
              current.removeChild(current.lastChild);
            }
            current.innerHTML = String(xhttp.responseText);
        } 
      }


      //-----------Find volunteers for create volunteers form---------------------
      let currently_visible = [];
      
      function DynamicForm1() {
        let data = document.forms.sectionform;
        let lastname = data['finduser1'].value;
        let options = document.getElementById("volselect");
        currently_visible.length = 0;

        if(lastname.length > 0){
            //request for emails from server
            token = document.querySelector('meta[name="csrf-token"]').content;

            var xhttp = new XMLHttpRequest();
            xhttp.open("get", "/findvolunteers/" + lastname, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
            xhttp.send();
            xhttp.onload = function(){
              while (options.firstChild) {
                options.removeChild(options.firstChild);
              }
              let obj = JSON.parse(xhttp.response)
              for (var i = 0; i < obj.length; i++) {
                let node = document.createElement("option");
                node.value = `${String(obj[i].firstname)}_${String(obj[i].lastname)}`;
                node.innerHTML = `${String(obj[i].firstname)} ${String(obj[i].lastname)}`;
                options.appendChild(node);
                currently_visible[`${String(obj[i].firstname)}_${String(obj[i].lastname)}`] = String(obj[i].Id);
              }
            } 
        }
      }

      function findId() {
        let data = document.forms.sectionform;
        let fullname = data['volselect'].value;
        if (currently_visible[fullname] !== undefined) {
            document.getElementById("volId").value = currently_visible[fullname];
        }
      }

      function delay2(callback, ms) {
        var timer = 0;
        return function() {
          var context = this, args = arguments;
          clearTimeout(timer);
          timer = setTimeout(function () {
            callback.apply(context, args);
          }, ms || 0);
        };
      }
      //event listner binds search actions
      document.getElementById("findvol2").addEventListener("keyup", delay2(DynamicForm2, 500), true);
      document.getElementById("finduser1").addEventListener("keyup", delay2(DynamicForm1, 500), true);
      document.getElementById("volselect").addEventListener("click", findId, true);






  // -----------------Calendar Test--------------------------------------------------
      let test = "title";
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        allDaySlot: false,
        initialView: 'listWeek',
        initialDate: '2023-06-02',
        headerToolbar: {
          left: 'prev next',
          center: 'title',
          right: 'listWeek,timeGridWeek,timeGridDay'
        }
      });

      //call database on page load and render these with correct values in loop
      calendar.addEvent({
        title: `${test}`,
        start: '2023-06-02T10:30:00',
        end: '2023-06-02T12:30:00',
        eventContent: 'some text'
      });
      calendar.addEvent({title: 'Event 2', start: '2023-06-02T12:30:00', end: '2023-06-02T16:30:00'});
      calendar.addEvent({title: 'Event 3', start: '2023-06-03T08:30:00', end: '2023-06-03T12:30:00'});
      calendar.addEvent({title: 'Event 4', start: '2023-06-03T14:30:00', end: '2023-06-4T17:30:00'});

      document.addEventListener('DOMContentLoaded', function() {
        calendar.render();
      });



//-----------------------------advanced div toggle by class-----------------------------
  function toggleDiv(inner) {
    let selected = ''
    switch(String(inner)) {
      case "Add Section":
        selected = 'section'
        break;
      case "Add Location":
        selected = 'location'
        break;
      case "Add Shift":
        selected = 'shift'
        break;
      case "Edit Volunteers":
        selected = 'editvol'
        break;
      case "Edit Section":
        selected = 'editsect'
        break;
    }
    if (!selected.includes('edit')){
      var divs = document.getElementsByClassName("createoptions");
      for(var i = 0; i < divs.length; i++){
          divs[i].style.display = "none";    
      }
    }else{
      var divs = document.getElementsByClassName("editoptions");
      for(var i = 0; i < divs.length; i++){
          divs[i].style.display = "none";    
      }
    }
    document.getElementById(selected).style.display = "block";
    if(selected == 'editsect'){
      document.getElementById('showcalendar').style.display = "block";
      calendar.render();
    }
  }


    var elements = document.getElementsByClassName("createoptionstoggle");
    Array.from(elements).forEach(function(element) {
      element.addEventListener('click', () =>{
        toggleDiv(element.innerText);
      });
    });

    var elements = document.getElementsByClassName("editoptionstoggle");
    Array.from(elements).forEach(function(element) {
      element.addEventListener('click', () =>{
        toggleDiv(element.innerText);
      });
    });

    //-------------------Form Toggling----------------------------------------------
    function toggleEdit(){
      let none = document.getElementsByClassName("toggleedit");
      document.getElementById("togglecreate").style.display = 'none';
      for(var i = 0; i < none.length; i++){
        none[i].style.display = "block";
      }
    }
    document.getElementById("showedit").addEventListener("click", toggleEdit, true);

    function toggleCreate(){
      let block = document.getElementsByClassName("toggleedit");
      document.getElementById("togglecreate").style.display = 'block';
      for(var i = 0; i < block.length; i++){
        block[i].style.display = "none";
      }
    }
    document.getElementById("showcreate").addEventListener("click", toggleCreate, true);