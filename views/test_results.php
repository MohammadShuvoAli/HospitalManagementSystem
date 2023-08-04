<?php
require '../controllers/check_doctor_session.php';
require '../models/test_results_model.php';
require '../controllers/test_results_controller.php';
include '../views/header.php';
include '../views/sidebar.php';
?>

<td width="80%" valign="top">
  <h2 align='center'>Test Result Information</h2>
  <br>
  <form id="searchForm" class="dashboard-form">
    <input type="text" id="searchInput" placeholder="Search Test Results by Patient's Name, Test Name">
  </form>
  <table id="searchResults" class="dashboard-tables"></table>
  <br>
  <table class="dashboard-tables">
    <thead>
      <tr>
        <th>Patient Name</th>
        <th>Test Name</th>
        <th>Test Date</th>
        <th>Test Result</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($test_results as $test_result) : ?>
        <tr>
          <td>
            <?php echo $test_result['first_name'] . " " . $test_result['last_name']; ?>
          </td>
          <td>
            <?php echo $test_result['test_name']; ?>
          </td>
          <td>
            <?php echo date('d F Y', strtotime($test_result['test_date'])); ?>
          </td>
          <td>
            <?php echo $test_result['test_result']; ?>
          </td>
          <td><button class="dashboard-table-button"><a href="edit_test.php?test_result_id=<?php echo $test_result['test_result_id']; ?>">Edit</a></button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <table align="center">
    <tr>
      <td>
        <button class="dashboard-table-button"><a href="add_test.php">Add Test for Patient</a></button>
      </td>
    </tr>
  </table>
  </tr>
  <script src="../views/js/test_results_search.js"></script>
  <?php include '../views/footer.php'; ?>