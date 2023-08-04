<?php
require '../controllers/check_doctor_session.php';
require '../models/referrals_model.php';
require '../controllers/referrals_controller.php';
include '../views/header.php';
include '../views/sidebar.php';
?>

<td width="80%" valign="top">
  <h2 align='center'>Refer Patient to different Doctor</h2>
  <script src="../views/js/validateForm.js"></script>
  <div class="dashboard-form">
    <form method="post" onsubmit="return validateReferralsForm();">
      <div id="error_messages"></div>
      <table align='center'>
        <tr>
          <td colspan="2">
            <div align='center'>
              <?php if (!empty($errors)) : ?>
                <?php foreach ($errors as $error) : ?>
                  <p class="error-message">
                    <?= $error ?>
                  </p>
                <?php endforeach; ?>
              <?php endif; ?>
              <?php if (isset($message)) : ?>
                <p class="error-message">
                  <?= $message ?>
                </p>
              <?php endif; ?>
            </div>
          </td>
        </tr>
        <tr>
          <td><label for="patient_id">Patient Name:</label></td>
          <td>
            <select name="patient_id" id="patient_id">
              <option value="">-Select Patient-</option>
              <?php foreach ($patients as $patient) : ?>
                <option value="<?php echo $patient['patient_id']; ?>"><?php echo $patient['first_name'] . ' ' . $patient['last_name']; ?></option>
              <?php endforeach; ?>
            </select>
          </td>
        </tr>
        <tr>
          <td><label for="doctor_id">Doctor Name:</label></td>
          <td>
            <select name="doctor_id" id="doctor_id">
              <option value="">-Select Doctor-</option>
              <?php foreach ($doctors as $doctor) : ?>
                <option value="<?php echo $doctor['doctor_id']; ?>"><?php echo $doctor['first_name'] . ' ' . $doctor['last_name']; ?></option>
              <?php endforeach; ?>
            </select>
          </td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
          <td></td>
          <td colspan="2" align="center">
            <input type="submit" name="submit" value="Refer Patient">
          </td>
        </tr>
      </table>
    </form>
  </div>
</td>
<?php include '../views/footer.php'; ?>