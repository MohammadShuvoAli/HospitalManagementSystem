<?php
require '../controllers/check_doctor_session.php';
require '../models/medical_report_model.php';
require '../controllers/medical_reports_controller.php';
include '../views/header.php';
include '../views/sidebar.php';
?>

<td width="80%" valign="top">
  <h2 align='center'>Medical Report Information</h2>
  <br>
  <form id="searchForm" class="dashboard-form">
    <input type="text" id="searchInput" placeholder="Search for Medical Reports by Patient's Name">
  </form>
  <table id="searchResults" class="dashboard-tables"></table>
  <br>
  <table class="dashboard-tables">
    <thead>
      <tr>
        <th>Patient Name</th>
        <th>Report Date</th>
        <th>Report Details</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($medical_reports as $medical_report) : ?>
        <tr>
          <td>
            <?php echo $medical_report['first_name'] . " " . $medical_report['last_name']; ?>
          </td>
          <td>
            <?php echo date('d F Y', strtotime($medical_report['report_date'])); ?>
          </td>
          <td>
            <?php echo $medical_report['report_details']; ?>
          </td>
          <td><button class="dashboard-table-button"><a href="edit_report.php?report_id=<?php echo $medical_report['report_id']; ?>">Edit</a></button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <table align="center">
    <tr>
      <td>
        <button class="dashboard-table-button"><a href="add_report.php">Add medical report for a patient</a></button>
      </td>
    </tr>
  </table>
  </tr>
  <script src="../views/js/medical_report_search.js"></script>
  <?php include '../views/footer.php'; ?>