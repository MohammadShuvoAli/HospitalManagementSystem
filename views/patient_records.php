<?php
require '../controllers/check_doctor_session.php';
require '../models/patient_records_model.php';
include '../views/header.php';
include '../views/sidebar.php';
?>
<td width="80%" valign="top">
  <h2 align="center">Patient Records</h2>
  <br>
  <form id="searchForm" class="dashboard-form">
    <input type="text" id="searchInput" placeholder="Search Patient's by Name, Email or Phone Number">
  </form>
  <table border="2" id="searchResults" class="dashboard-tables"></table>
  <br>
  <table class="dashboard-tables">
    <thead>
      <tr>
        <th>Patient Name</th>
        <th>Date of Birth</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Email</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($patients as $patient) : ?>
        <tr>
          <td>
            <?php echo ucfirst($patient['first_name']) . " " . ucfirst($patient['last_name']); ?>
          </td>
          <td>
            <?php echo date('d F Y', strtotime($patient['date_of_birth'])); ?>
          </td>
          <td>
            <?php echo ucfirst($patient['gender']); ?>
          </td>
          <td>
            <?php echo $patient['address']; ?>
          </td>
          <td>
            <?php echo $patient['phone']; ?>
          </td>
          <td>
            <?php echo $patient['email']; ?>
          </td>
          <td><button class="dashboard-table-button"><a href="edit_patient.php?patient_id=<?php echo $patient['patient_id']; ?>">Edit</a></button></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <table align="center">
    <tr>
      <td>
        <button class="dashboard-table-button"><a href="add_patient.php">Add Patient</a></button>
      </td>
    </tr>
  </table>
  </tr>
  <script src="../views/js/patient_record_search.js"></script>
  <?php include '../views/footer.php'; ?>