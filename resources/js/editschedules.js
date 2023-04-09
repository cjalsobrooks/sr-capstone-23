      
            //---------------------------Create new DB entities---------------------------------
            function create(val) {
              // Form fields, see IDs above
              let createURL = '';
              let refreshURL = '';
              let targetDiv= '';
              let params;
      
              switch(val) {
              case 1:
                createURL = '/createsection';
                refreshURL = '/refreshsections';
                targetDiv = 'target1';
                params = {
                  volId: document.querySelector('#volId').value,
                  sectionName: document.querySelector('#section-name').value,
                  sectionDescription: document.querySelector('#section-description').value
                }
                break;
              case 2:
                createURL = '/createlocation';
                refreshURL = '/refreshlocations';
                targetDiv = 'target2'
                params = {
                  sectionId: document.querySelector('#sectionId').value,
                  locationName: document.querySelector('#location-name').value,
                  locationDescription: document.querySelector('#location-description').value
                }
                break;
              case 3:
                createURL = '/createshift';
                refreshURL = '';
                targetDiv = ''
                params ={
                  locationId: document.querySelector('#locationoptions2').value,
                  sectionId: document.querySelector('#sectionId3').value,
                  shiftName: document.querySelector('#shift-name').value,
                  shiftDescription: document.querySelector('#shift-description').value,
                  shiftDay: document.querySelector('#shift-day').value,
                  startTime: document.querySelector('#start-time').value,
                  endTime: document.querySelector('#end-time').value,
                  numVolunteers: document.querySelector('#num-volunteers').value
                }
                break;
            }
      
              const xhttp = new XMLHttpRequest();
              xhttp.open('POST', createURL);
              xhttp.setRequestHeader("X-CSRF-TOKEN", token); 
              xhttp.setRequestHeader('Content-type', 'application/json');
              xhttp.send(JSON.stringify(params));
              xhttp.onload = function() {
                  alert(xhttp.responseText);
                  refreshValues(refreshURL,targetDiv);
              }
          }
      
          let submitSection = document.getElementById("addsection");
          submitSection.addEventListener('click', () =>{
            create(1);
          });
      
          let submitLocation = document.getElementById("addlocation");
          submitLocation.addEventListener('click', () =>{
            create(2);
          });
      
          let submitShift = document.getElementById("addshift");
          submitShift.addEventListener('click', () =>{
            create(3);
          });
      
          //---------------------------refresh calendar location options---------------------------------
        
            function DynamicForm3(sectionIdTag, locationOptionsTag) {
              let sectionId = document.querySelector(sectionIdTag).value
              let options = document.getElementById(locationOptionsTag);
              var xhttp = new XMLHttpRequest();
              xhttp.open("get", "/findlocations/" + sectionId, true);
              xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
              xhttp.send();
              xhttp.onload = function(){
                while (options.firstChild) {
                  options.removeChild(options.firstChild);
                }
                let obj = JSON.parse(xhttp.response)
                if(obj.length > 0){
                  let nodeDefault = document.createElement("option");
                  nodeDefault.value="0";
                  nodeDefault.innerHTML="--- select a location ---";
                  options.appendChild(nodeDefault);
                }
                for(var i = 0; i < obj.length; i++){
                  let node = document.createElement("option");
                  node.value = `${String(obj[i].id)}`;
                  node.innerHTML = `${String(obj[i].name)}`;
                  options.appendChild(node);
                }
              }
            }
      
          //---------------Calendar definition statement-------------------------------
          var calendarEl = document.getElementById('calendar');
                  
          var calendar = new FullCalendar.Calendar(calendarEl, {
            allDaySlot: false,
            initialView: 'list',
            initialDate: '2023-06-02',
            duration: {days: 3},
            headerToolbar: {
              left: 'prev next',
              center: 'title',
              right: 'list,timeGrid,timeGridDay'
            }
          });
      
          document.addEventListener('DOMContentLoaded', function() {
            calendar.render();
          });
      
      
      
            //--------load the calendar--------------------------------------------------
            function LoadCalendar() {
      
              calendar.removeAllEvents();
              let sectionId = document.querySelector('#locationoptions').value
              if(sectionId == ""){
                sectionId=0;
              }
              var xhttp = new XMLHttpRequest();
              xhttp.open("get", "/findshifts/" + sectionId, true);
              xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
              xhttp.send();
              xhttp.onload = function(){
                let obj = JSON.parse(xhttp.response)
                for(var i = 0; i < obj.length; i++){
                  //call database on page load and render these with correct values in loop
                  calendar.addEvent({
                    title: `${String(obj[i].current)} out of ${String(obj[i].max)} / Click to view`,
                    start: String(obj[i].start),
                    end: String(obj[i].end),
                    url: `/editroster/${String(obj[i].id)}`
                  });
                }
      
                calendar.render();
              }
            }
      
            //event listner binds search actions
            document.getElementById("sectionId2").addEventListener("click", ()=>{
              DynamicForm3('#sectionId2','locationoptions');
            });
            document.getElementById("locationoptions").addEventListener("change", LoadCalendar);
      
            //reuse Dynamic form 3 for shift creation form
            document.getElementById("sectionId3").addEventListener("click", ()=>{
              DynamicForm3('#sectionId3','locationoptions2');
            });
      
      
      
      
      
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
            var xhttp = new XMLHttpRequest();
            xhttp.open("get", "/findvolunteers/" + lastname, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
            xhttp.send();
            xhttp.onload = function(){
              while (options.firstChild) {
                options.removeChild(options.firstChild);
              }
              let obj = JSON.parse(xhttp.response)
              if(obj.length > 0){
                let nodeDefault = document.createElement("option");
                nodeDefault.value="0";
                nodeDefault.innerHTML="--- select a volunteer ---";
                options.appendChild(nodeDefault);
              }
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

      //event listner binds search actions
      document.getElementById("findvol2").addEventListener("keyup", delay(DynamicForm2, 500), true);
      document.getElementById("finduser1").addEventListener("keyup", delay(DynamicForm1, 500), true);
      document.getElementById("volselect").addEventListener("click", findId, true);


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


