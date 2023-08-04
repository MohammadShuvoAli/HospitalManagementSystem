<?php
session_start();
require '../models/forget_password_model.php';
require '../controllers/forget_password_controller.php';
include '../views/header.php';
?>

<tr>
  <td colspan="2">
    <h2 align='center'>Forget Password</h2>
  </td>
</tr>
<tr>
  <td colspan="2">
    <script src="../views/js/validateForm.js"></script>
    <div class="dashboard-form">
      <form method="post" onsubmit="return validateForgetPasswordForm();">
        <div id="error_messages"></div>
        <table align='center'>
          <tr>
            <td colspan=2 align='center'>
              <?php if (isset($error)) : ?>
                <p align='center' class="error-message">
                  <?php echo $error; ?>
                </p>
              <?php endif; ?>
              <?php if (isset($success)) : ?>
                <p align='center' class="success-message">
                  <?php echo $success; ?>
                </p>
              <?php endif; ?>
            </td>
          </tr>
          <tr>
            <td><label for="email">Email:</label></td>
            <td><input type="email" name="email" id="email"></td>
          </tr>
          <tr>
            <td></td>
            <td align='center'>
              <input type="submit" name="submit" value="Submit">
              <input type="reset" value="Reset">
            </td>
          </tr>
        </table>
      </form>
    </div>
  </td>
</tr>

<?php include '../views/footer.php'; ?>