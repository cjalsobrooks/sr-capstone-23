      
      //-------------button triggers email event-------------------------

      //=================!!!!!! WARNING !!!!!!!======================================================
      // Please read here before taking action.

      // I assume if you are reading this then you want to send emails.
      // Before uncommenting this function please check carefully in the database
      // to ensure there are no fake email addresses. Sending emails to fake addresses
      // or sending emails that are bounced back from the recipient address lowers the reputation
      // score with the smtp provider. This may result in the banning or cancelling of our email service.

      // Comment this function back when done testing


      function SendMailAll() {
        if(confirm("Are you sure you want to send all?")){
          let form = document.forms.emailform2;
          var formData = new FormData();
          formData.append('messageall', form['messageall'].value);
          var xhttp = new XMLHttpRequest();
          xhttp.open("post", "/emailall", true);
          xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
          xhttp.send(formData);
          xhttp.onload = function(){
            alert(xhttp.response);
          }
        }
      }
      document.getElementById("sendemail2").addEventListener("click", SendMailAll, false);

      function SendMailUser() {
        if(confirm("Are you sure you want to send?")){
          let form = document.forms.emailform;
          var formData = new FormData();
          formData.append('messageuser', form['messageuser'].value);
          formData.append('emailselect', form['emailselect'].value);
          var xhttp = new XMLHttpRequest();
          xhttp.open("post", "/emailuser", true);
          xhttp.setRequestHeader("X-CSRF-TOKEN", token);
          xhttp.send(formData);
          xhttp.onload = function(){
            alert(xhttp.response);
          }
        }
      }
      document.getElementById("sendemail").addEventListener("click", SendMailUser, false);

      function SendMailSection() {
        if(confirm("Are you sure you want to send?")){
          let form = document.forms.emailform3;
          var formData = new FormData();
          formData.append('messagesection', form['messageuser'].value);
          formData.append('sectionselect', form['sectionselect'].value);
          var xhttp = new XMLHttpRequest();
          xhttp.open("post", "/emailsection", true);
          xhttp.setRequestHeader("X-CSRF-TOKEN", token);
          xhttp.send(formData);
          xhttp.onload = function(){
            alert(xhttp.response);
          }
        }
      }
      document.getElementById("sendemail3").addEventListener("click", SendMailSection, false);


      //===================================================================================================

      //-----------Find user emails javascript logic---------------------
      let currently_visible = [];

      function DynamicForm1() {
        let data = document.forms.emailform;
        let lastname = data['finduser'].value;
        let options = document.getElementById("userselect");

        currently_visible.length = 0;
        
        if(lastname.length > 0){
            //request for emails from server

            var xhttp = new XMLHttpRequest();
            xhttp.open("get", "/findemail/" + lastname, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
            xhttp.send();
            xhttp.onload = function(){
              while (options.firstChild) {
                options.removeChild(options.firstChild);
              }
              let obj = JSON.parse(xhttp.response)
              for (var i = 0; i < obj.length; i++) {
                let node = document.createElement("option");
                node.value = String(obj[i].lastname);
                node.innerHTML = `${String(obj[i].firstname)} ${String(obj[i].lastname)}`;
                options.appendChild(node);
                currently_visible[String(obj[i].lastname)] = String(obj[i].email);
              }
            } 
        }
      }

      function findEmail() {
        let data = document.forms.emailform;
        let lastname = data['userselect'].value;
        if (currently_visible[lastname] !== undefined) {
            document.getElementById("emailselect").value = currently_visible[lastname];
        }
      }
      
      document.getElementById("userselect").addEventListener("click", findEmail, true);
      document.getElementById("finduser").addEventListener("keyup", delay(DynamicForm1, 500), true);

      //-------------------Form Toggling----------------------------------------------
      function toggleOne(){
        document.getElementById("emailform").style.display = 'block';
        document.getElementById("emailform2").style.display = 'none';
        document.getElementById("emailform3").style.display = 'none';
      }
      document.getElementById("showone").addEventListener("click", toggleOne, true);

      function toggleAll(){
        document.getElementById("emailform").style.display = 'none';
        document.getElementById("emailform2").style.display = 'block';
        document.getElementById("emailform3").style.display = 'none';
      }
      document.getElementById("showall").addEventListener("click", toggleAll, true);

      function toggleSection(){
        document.getElementById("emailform").style.display = 'none';
        document.getElementById("emailform2").style.display = 'none';
        document.getElementById("emailform3").style.display = 'block';
      }
      document.getElementById("showsection").addEventListener("click", toggleSection, true);
