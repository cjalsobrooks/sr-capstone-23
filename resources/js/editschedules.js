      //-----------Find user javascript logic---------------------
      function DynamicForm2() {
        let data = document.forms.usereditsearch;
        let lastname = data['finduser2'].value;
        let body = document.getElementById('responsivebody')

        //request for emails from server
        var xhttp = new XMLHttpRequest();
        if(lastname.length==0){
          xhttp.open("get", "/findusers/" + 0, true);
        }else{
          xhttp.open("get", "/findusers/" + lastname, true);
        }
        xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
        xhttp.send();
        xhttp.onreadystatechange = function(){

          while (body.firstChild) {
            body.removeChild(body.firstChild);
          }
          let obj = JSON.parse(xhttp.response)
          for (let i = 0; i < obj.length; i++) {
            const tr = body.insertRow();
            for(let prop in obj[i].user){
              const td = tr.insertCell();
              td.appendChild(document.createTextNode(obj[i].user[prop]));
            }

            //edit
            const tdEdit = tr.insertCell();
            let a = document.createElement('a');
            a.style.textDecoration = "none";
            a.appendChild(document.createTextNode("edit"));
            a.href = `/permissions/${obj[i].user["id"]}`;
            tdEdit.appendChild(a);

          }
        } 
      }


      //-----------Find users full name javascript logic---------------------
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
            xhttp.onreadystatechange = function(){
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
            console.log(document.getElementById("volId").value)
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

      document.getElementById("finduser2").addEventListener("keyup", delay2(DynamicForm2, 500), true);
      document.getElementById("finduser1").addEventListener("keyup", delay2(DynamicForm1, 500), true);
      document.getElementById("volselect").addEventListener("click", findId, true);


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



      //-----------------Calendar Test------------------------------
      let test = "title";

      document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        allDaySlot: false,
        initialView: 'timeGridWeek',
        initialDate: '2023-06-02',
        headerToolbar: {
          left: 'prev',
          center: 'title',
          right: 'next'
        }
      });

      //call database on page load and render these with correct values in loop
      calendar.addEvent({title: `${test}`, start: '2023-06-02T10:30:00', end: '2023-06-02T12:30:00'});
      calendar.addEvent({title: 'Event 2', start: '2023-06-02T12:30:00', end: '2023-06-02T16:30:00'});
      calendar.addEvent({title: 'Event 3', start: '2023-06-03T08:30:00', end: '2023-06-412:30:00'});
      calendar.addEvent({title: 'Event 4', start: '2023-06-03T14:30:00', end: '2023-06-4T17:30:00'});

      calendar.render();
  });