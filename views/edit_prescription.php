<?php
require '../controllers/check_doctor_session.php';
require '../models/edit_prescription_model.php';
require '../controllers/edit_prescription_controller.php';
include '../views/header.php';
include '../views/sidebar.php';
?>

<td width="80%" valign="top">
  <h2 align='center'>Edit Prescription Details</h2>
  <div class="dashboard-form">
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
      <table align="center">
        <tr>
          <td><input type="hidden" name="prescription_id" value="<?php echo $prescription['prescription_id']; ?>" readonly></td>
        </tr>
        <tr>

          <td><input type="hidden" name="appointment_id" value="<?php echo $prescription['appointment_id']; ?>" readonly></td>
        </tr>
        <tr>

          <td><input type="hidden" name="patient_id" value="<?php echo $prescription['patient_id']; ?>" readonly></td>
        </tr>
        <tr>
          <td> <label for="medicine_name">Medicine Name:</label></td>
          <td><input type="text" name="medicine_name" value="<?php echo $prescription['medicine_name']; ?>"></td>
        </tr>
        <tr>
          <td> <label for="dosage">Dosage:</label></td>
          <td><input type="text" name="dosage" value="<?php echo $prescription['dosage']; ?>"></td>
        </tr>
        <tr>
          <td> <label for="duration">Duration:</label></td>
          <td><input type="text" name="duration" value="<?php echo $prescription['duration']; ?>"></td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2" align="center">
            <input type="submit" name="update" value="Update">
            <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you want to delete this prescription?');">
          </td>
        </tr>
      </table>
      <br>
    </form>
  </div>
</td>
</tr>
<?php include '../views/footer.php'; ?>