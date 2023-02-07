// function SendMail() {
//   token = document.querySelector('meta[name="csrf-token"]').content;
//   var xhttp = new XMLHttpRequest();
//   xhttp.open("get", "/testmail", false);
//   xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
//   xhttp.send();

//   if(xhttp.readyState == 4 && xhttp.response == 200){
//     console.log("success")  
//   }else{
//     console.log(xhttp.response)
//   }
// }
// document.getElementById("sendemail").addEventListener("click", SendMail, false);