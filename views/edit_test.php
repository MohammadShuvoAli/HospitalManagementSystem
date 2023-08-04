<?php
require '../controllers/check_doctor_session.php';
require '../models/edit_test_model.php';
require '../controllers/edit_test_controller.php';
include '../views/header.php';
include '../views/sidebar.php';
?>
<td width="80%" valign="top">
  <h2 align='center'>Edit Test Details</h2>
  <div class="dashboard-form">
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
      <table align="center">
        <tr>
          <td><input type="hidden" name="test_result_id" value="<?php echo $test_results['test_result_id']; ?>"></td>
        </tr>
        <tr>
          <td><input type="hidden" name="patient_id" value="<?php echo $test_results['patient_id']; ?>"></td>
        </tr>
        <tr>
          <td> <label for="test_name">Test Name:</label></td>
          <td><input type="text" name="test_name" value="<?php echo $test_results['test_name']; ?>"></td>
        </tr>
        <tr>
          <td> <label for="test_date">Test Date:</label></td>
          <td><input type="date" name="test_date" value="<?php echo $test_results['test_date']; ?>"></td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2" align="center">
            <input type="submit" name="update" value="Update">
            <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you want to delete this test for patient?');">
          </td>
        </tr>
      </table>
      <br>
    </form>
  </div>
</td>
</tr>
<?php include '../views/footer.php'; ?>