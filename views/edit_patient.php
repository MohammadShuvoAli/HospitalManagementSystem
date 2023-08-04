<?php
require '../controllers/check_doctor_session.php';
require '../controllers/edit_patient_controller.php';
require '../models/edit_patient_model.php';

include '../views/header.php';
include '../views/sidebar.php';
?>

<td width="80%" valign="top">
  <h2 align='center'>Edit Patient Details</h2>
  <div class="dashboard-form">
    <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
      <input type="hidden" name="patient_id" value="<?php echo $patient['patient_id']; ?>">
      <table align="center">
        <tr>
          <td> <label>First Name: </label></td>
          <td><input type="text" name="first_name" value="<?php echo $patient['first_name']; ?>" required></td>
        </tr>
        <tr>
          <td> <label>Last Name:</label></td>
          <td><input type="text" name="last_name" value="<?php echo $patient['last_name']; ?>" required></td>
        </tr>
        <tr>
          <td><label for="email">Email:</label></td>
          <td><input type="email" id="email" name="email" value="<?php echo $patient['email']; ?>" required></td>
        </tr>
        <tr>
          <td><label>Date of Birth:</label></td>
          <td><input type="date" name="date_of_birth" value="<?php echo $patient['date_of_birth']; ?>" required></td>
          <?php
          if (isset($email_error)) {
            echo $email_error;
          }
          ?>
        </tr>
        <tr>
          <td><label>Gender:</label></td>
          <td>
            <input type="radio" name="gender" value="male" <?php if ($patient['gender'] == 'male')
                                                              echo 'checked'; ?>> Male
            <input type="radio" name="gender" value="female" <?php if ($patient['gender'] == 'female')
                                                                echo 'checked'; ?>> Female
            <input type="radio" name="gender" value="other" <?php if ($patient['gender'] == 'other')
                                                              echo 'checked'; ?>> Other
          </td>
        </tr>
        <tr>
          <td><label for="address">Address</label></td>
          <td>
            <textarea id="address" name="address" required><?php echo $patient['address']; ?></textarea>
          </td>
        </tr>
        <tr>
          <td><label for="phone">Phone</label></td>
          <td><input type="tel" id="phone" name="phone" pattern="[0-9]*" value="<?php echo $patient['phone']; ?>" required></td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2" align="center">
            <input type="submit" name="update" value="Update">
            <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you want to delete this patient record?');">
          </td>
        </tr>
      </table>
      <br>
    </form>
  </div>
</td>
</tr>
<?php include '../views/footer.php'; ?>