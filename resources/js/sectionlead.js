


// document.getElementById('sectionId').addEventListener('click', ()=>{
//   updateLocationBox();
// });

// function updateLocationBox() {
//   let sectionId = document.getElementById('sectionId').value
//   let options = document.getElementById('locationId');
//   var xhttp = new XMLHttpRequest();
//   xhttp.open("get", "/secLeadFindLocations/" + sectionId, true);
//   xhttp.setRequestHeader("X-CSRF-TOKEN", token);  
//   xhttp.send();
//   xhttp.onload = function(){
//     while (options.firstChild) {
//       options.removeChild(options.firstChild);
//     }
//     let obj = JSON.parse(xhttp.response)
//     if(obj.length > 0){
//       let nodeDefault = document.createElement("option");
//       nodeDefault.value="0";
//       nodeDefault.innerHTML="--- select a location ---";
//       options.appendChild(nodeDefault);
//     }
//     for(var i = 0; i < obj.length; i++){
//       let node = document.createElement("option");
//       node.value = `${String(obj[i].id)}`;
//       node.innerHTML = `${String(obj[i].name)}`;
//       options.appendChild(node);
//     }
//   }
// }