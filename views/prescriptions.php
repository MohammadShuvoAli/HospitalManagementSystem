<?php
require '../controllers/check_doctor_session.php';
require '../models/prescriptions_model.php';
include '../views/header.php';
include '../views/sidebar.php';
?>

<td width="80%" valign="top">
  <h2 align='center'>Prescription Information</h2>
  <br>
  <form id="searchForm" class="dashboard-form">
    <input type="text" id="searchInput" placeholder="Search Prescription by Patient's Name or Medicine Name">
  </form>
  <table id="searchResults" class="dashboard-tables"></table>
  <br>
  <table class="dashboard-tables">
    <thead>
      <tr>
        <th>Patient Name</th>
        <th>Medicine Name</th>
        <th>Dosage</th>
        <th>Duration</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($prescriptions as $prescription) : ?>
        <tr>
          <td>
            <?php echo $prescription['first_name'] . " " . $prescription['last_name']; ?>
          </td>
          <td>
            <?php echo $prescription['medicine_name']; ?>
          </td>
          <td>
            <?php echo $prescription['dosage']; ?>
          </td>
          <td>
            <?php echo $prescription['duration']; ?>
          </td>
          <td><button class="dashboard-table-button"><a href="edit_prescription.php?prescription_id=<?php echo $prescription['prescription_id']; ?>">Edit</a></button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <table align="center">
    <tr>
      <td>
        <button class="dashboard-table-button"><a href="add_prescription.php">Add Prescription</a></button>
      </td>
    </tr>
  </table>
  </tr>
  <script src="../views/js/prescription_search.js"></script>
  <?php include '../views/footer.php'; ?>