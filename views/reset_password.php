<?php
session_start();
require '../models/reset_password_model.php';
require '../controllers/reset_password_controller.php';
include '../views/header.php';
?>

<tr>
    <td colspan="2">
        <h1 align='center'>Reset Password</h1>
    </td>
</tr>
<tr>
    <td colspan="2">
        <script src="../views/js/validateForm.js"></script>
        <div class="dashboard-form">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?token=" . $token); ?>" onsubmit="return validateResetPasswordForm();">
                <div id="error_messages"></div>
                <table align='center'>
                    <tr>
                        <td colspan=2 align='center'>
                            <?php
                            // Display error messages
                            if (!empty($new_password_err)) {
                                echo "<p class='error-message'>" . $new_password_err . "</p>" . "<br>";
                            }
                            if (!empty($confirm_password_err)) {
                                echo "<br>" . $confirm_password_err . "<br>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><label>New Password:</label></td>
                        <td><input type="password" name="new_password" value="<?php echo htmlspecialchars($new_password); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td><label>Confirm Password:</label></td>
                        <td><input type="password" name="confirm_password" value="<?php echo htmlspecialchars($confirm_password); ?>">
                        </td>
                    </tr>
                    <td></td>
                    <td colspan=2 align='center'>
                        <input type="submit" value="Submit">
                        <button><a href="index.php">Cancel</a></button>
                    </td>
</tr>
</table>
</form>
</div>
</td>
</tr>
<?php include '../views/footer.php';
