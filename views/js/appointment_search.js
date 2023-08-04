// Attach an event listener to the search input field
document.getElementById('searchInput').addEventListener('input', function () {
  // Get the search query from the input field
  var search = this.value;

  if (search === '') {
    // Clear the previous search results
    var table = document.getElementById('searchResults');
    table.innerHTML = '';
    return; // Exit the function early if search query is empty
  }
  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {

      if (xhr.status === 200) {
        // Clear the previous search results
        var table = document.getElementById('searchResults');
        table.innerHTML = '';

        // Parse the JSON response and loop through the fetched patient data
        var appointments = JSON.parse(xhr.responseText);

        // Insert the table header row
        var headerRow = table.insertRow();
        headerRow.innerHTML = '<th>Patient Name</th><th>Appointment Date</th><th>Appointment Time</th><th>Appointment Status</th><th></th>';

        for (var i = 0; i < appointments.length; i++) {
          var appointment = appointments[i];
          var row = table.insertRow();
          row.insertCell().textContent = appointment.first_name + ' ' + appointment.last_name;
          row.insertCell().textContent = appointment.appointment_date;
          row.insertCell().textContent = appointment.appointment_time;
          row.insertCell().textContent = appointment.appointment_status;

          // Insert the "Edit" button cell
          var editButtonCell = row.insertCell();
          editButtonCell.innerHTML = '<button class="dashboard-table-button"><a href="edit_appointment.php?appointment_id= ' + appointment.appointment_id + '">Edit</a></button>';
        }
      }
    }
  };

  // Open and send the AJAX request
  xhr.open('POST', '../models/live_appointment_search.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send('search=' + search);
});