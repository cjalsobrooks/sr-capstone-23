      
      //-------------button triggers email event-------------------------

      //=================!!!!!! WARNING !!!!!!!======================================================
      // Please read here before taking action.

      // I assume if you are reading this then you want to send emails.
      // Before uncommenting this function please check carefully in the database
      // to ensure there are no fake email addresses. Sending emails to fake addresses
      // or sending emails that are bounced back from the recipient address lowers the reputation
      // score with the smtp provider. This may result in the banning or cancelling of our email service.

      // Comment this function back when done testing


      function SendMail() {
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
      document.getElementById("sendemail").addEventListener("click", SendMail, false);

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

      function delay1(callback, ms) {
          var timer = 0;
          return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
              callback.apply(context, args);
            }, ms || 0);
          };
        }


      function findEmail() {
        let data = document.forms.emailform;
        let lastname = data['userselect'].value;
        if (currently_visible[lastname] !== undefined) {
            document.getElementById("emailselect").value = currently_visible[lastname];
        }
      }
      
      document.getElementById("userselect").addEventListener("click", findEmail, true);
      document.getElementById("finduser").addEventListener("keyup", delay1(DynamicForm1, 500), true);

      //-------------------Form Toggling----------------------------------------------
      function toggleOne(){
        document.getElementById("emailform").style.display = 'block';
        document.getElementById("emailform2").style.display = 'none';
      }
      document.getElementById("showone").addEventListener("click", toggleOne, true);

      function toggleAll(){
        document.getElementById("emailform").style.display = 'none';
        document.getElementById("emailform2").style.display = 'block';
      }
      document.getElementById("showall").addEventListener("click", toggleAll, true);
