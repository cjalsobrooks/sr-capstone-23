$(document).ready(function () {
    $.ajax({
        url: '/findGroupByID',
        type: 'GET',
        success: function (response) {
            const editVolunteerLinks = document.querySelectorAll('.edit-volunteer');
            editVolunteerLinks.forEach(link => {
                const volunteerId = link.getAttribute('data-id');
                link.href = permissionsUrl + '?volunteer_id=' + volunteerId;
            });
                        
            var data = JSON.parse(response);
            var table = '<table class="table">';
            table += '<thead><tr>';
            table += '<th>Volunteer ID</th>';
            table += '<th>First Name</th>';
            table += '<th>Last Name</th>';
            table += '<th>Edit</th>';
            table += '<th>Delete</th>';
            table += '</tr></thead>';
            table += '<tbody>';
            for (var i = 0; i < data.length; i++) {
                table += '<tr>';
                table += '<td>' + data[i]['Id'] + '</td>';
                table += '<td>' + data[i]['firstname'] + '</td>';
                table += '<td>' + data[i]['lastname'] + '</td>';
                table += '<td><a style="text-decoration: none;" href="{{ route('permissions', ['id' => Auth::user()->id]) }}">Edit</a></td>';
                table += '<td><a style="text-decoration: none;" href="#">Delete</a></td>';
                table += '</tr>';
            }
            table += '</tbody></table>';
            $('#volunteers-table').html(table);
        }
    });
});
