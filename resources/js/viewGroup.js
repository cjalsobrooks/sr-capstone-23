const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const xhttp = new XMLHttpRequest();
xhttp.open('GET', '/viewgroup', true);
xhttp.setRequestHeader("X-CSRF-TOKEN", token);
xhttp.setRequestHeader('Content-type', 'application/json');
xhttp.send();
xhttp.onload = function() {
  loadTable();
};

function loadTable() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var data = JSON.parse(this.responseText);
      var table = '<table class="table">';
      table += '<thead><tr>';
      table += '<th>Volunteer ID</th>';
      table += '<th>First Name</th>';
      table += '<th>Last Name</th>';
      table += '</tr></thead>';
      table += '<tbody>';
      for (var i = 0; i < data.volunteers.length; i++) {
        var volunteer = data.volunteers[i];
        table += '<tr>';
        table += '<td>' + volunteer.id + '</td>';
        table += '<td>' + volunteer.first_name + '</td>';
        table += '<td>' + volunteer.last_name + '</td>';
        table += '</tr>';
      }
      table += '</tbody></table>';
      document.getElementById('volunteers-table').innerHTML = table;
    }
  };
  xhr.open('GET', '/findGroupByID', true);
  xhr.send();
}
