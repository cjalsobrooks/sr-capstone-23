
      //-----------Find user emails javascript logic---------------------
      function DynamicForm2() {
        let data = document.forms.usereditsearch;
        let lastname = data['finduser2'].value;
        let body = document.getElementById('responsivebody');

        //request for emails from server
        token = document.querySelector('meta[name="csrf-token"]').content;
        var xhttp = new XMLHttpRequest();
        if(lastname.length==0){
          xhttp.open("get", "/findusers/" + 0, true);
        }else{
          xhttp.open("get", "/findusers/" + lastname, true);
        }
        xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
        xhttp.send();
        xhttp.onload = function(){

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

            //delete
            const tdDelete = tr.insertCell();
            a = document.createElement('a');
            a.style.textDecoration = "none";
            a.appendChild(document.createTextNode("delete"));
            a.href = `#`; //<--- fix this later
            tdDelete.appendChild(a);

          }
        } 
      }
      
      document.getElementById("finduser2").addEventListener("keyup", delay(DynamicForm2, 500), true);