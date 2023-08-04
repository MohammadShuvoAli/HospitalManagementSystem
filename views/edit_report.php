<?php
require '../controllers/check_doctor_session.php';
require '../models/edit_report_model.php';
require '../controllers/edit_report_controller.php';
include '../views/header.php';
include '../views/sidebar.php';
?>
<td width="80%" valign="top">
  <h2 align='center'>Edit Medical Report</h2>
  <div class="dashboard-form">
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
      <table align="center">
        <tr>
          <td><input type="hidden" name="report_id" value="<?php echo $medical_reports['report_id']; ?>"></td>
        </tr>
        <tr>
          <td> <label for="report_date">Report Date:</label></td>
          <td><input type="date" name="report_date" value="<?php echo $medical_reports['report_date']; ?>"></td>
        </tr>
        <tr>
          <td><label for="report_details">Report Details:</label></td>
          <td><textarea name="report_details"><?php echo $medical_reports['report_details']; ?></textarea></td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2" align="center">
            <input type="submit" name="update" value="Update">
            <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you want to delete this report?');">
          </td>
        </tr>
      </table>
      <br>
    </form>
  </div>
</td>
</tr>
<?php include '../views/footer.php'; ?>