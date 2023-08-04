<?php
require '../controllers/check_doctor_session.php';
require '../models/appointments_model.php';
include '../views/header.php';
include '../views/sidebar.php';
?>

<td width="80%" valign="top">
  <h2 align='center'>Appointment Information</h2>
  <br>
  <form id="searchForm" method="post" class="dashboard-form">
    <input type="text" id="searchInput" name="searchInput" placeholder="Search Appointment by patient's name">
  </form>
  <br>
  <div class="table-wrapper">
    <table id="searchResults" class="dashboard-tables">
      <thead>
        <tr>
          <th>Patient Name</th>
          <th>Appointment Date</th>
          <th>Appointment Time</th>
          <th>Appointment Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($appointments as $appointment) : ?>
          <tr>
            <td>
              <?php echo $appointment['first_name'] . " " . $appointment['last_name']; ?>
            </td>
            <td>
              <?php echo date('d F Y', strtotime($appointment['appointment_date'])); ?>
            </td>
            <td>
              <?php echo date('h:i A', strtotime($appointment['appointment_time'])); ?>
            </td>
            <td>
              <?php echo $appointment['appointment_status']; ?>
            </td>
            <td><button class="dashboard-table-button"><a href="edit_appointment.php?appointment_id=<?php echo $appointment['appointment_id']; ?>">Edit</a></button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <table align="center">
    <tr>
      <td>
        <button class="dashboard-table-button"><a href="add_appointment.php">Schedule Appointment</a></button>
      </td>
    </tr>
  </table>
  </tr>
  <script>
    // Add an event listener for input changes
    document.getElementById("searchInput").addEventListener("input", function(event) {
      // Get the search input value
      var searchInput = event.target.value;

      // Send AJAX request to server
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // Parse JSON response
            var results = JSON.parse(xhr.responseText);
            var tableBody = document.getElementById("searchResults").getElementsByTagName("tbody")[0];

            // Clear previous results
            tableBody.innerHTML = "";

            // Loop through the results and append as rows to the table
            for (var i = 0; i < results.length; i++) {
              var row = document.createElement("tr");
              row.innerHTML = "<td>" + results[i].first_name + ' ' + results[i].last_name + "</td>" +
                "<td>" + results[i].appointment_date + "</td>" +
                "<td>" + results[i].appointment_time + "</td>" +
                "<td>" + results[i].appointment_status + "</td>";
              tableBody.appendChild(row);
            }
          } else {
            console.error("Error: " + xhr.status);
          }
        }
      };
      xhr.open("POST", "../models/live_appointment_search.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=UTF-8");
      xhr.send("searchInput=" + encodeURIComponent(searchInput));
    });
  </script>
  <?php include '../views/footer.php'; ?>