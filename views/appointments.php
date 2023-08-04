<?php
require '../controllers/check_doctor_session.php';
require '../models/appointments_model.php';
include '../views/header.php';
include '../views/sidebar.php';
?>

<td width="80%" valign="top">
  <h2 align='center'>Appointment Information</h2>
  <br>
  <form id="searchForm" class="dashboard-form">
    <input type="text" id="searchInput" placeholder="Search Appointment by Patient's Name">
  </form>
  <div class="table-wrapper">
    <table id="searchResults" class="dashboard-tables"></table>
    <br>
    <table class="dashboard-tables">
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
            <td><button class="dashboard-table-button"><a href="../views/edit_appointment.php?appointment_id=<?php echo $appointment['appointment_id']; ?>">Edit</a></button>
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
  <script src="../views/js/appointment_search.js"></script>
  <?php include '../views/footer.php'; ?>