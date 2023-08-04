<?php
require '../models/change_password_model.php';
require '../controllers/change_password_controller.php';
include '../views/header.php';
?>

<tr>
    <td colspan="2">
        <h2 align='center'>Change Password</h2>
    </td>
</tr>
<tr>
    <td align='center'>
        <?php if (isset($message)) : ?>
            <p class="error-message">
                <?= $message ?>
            </p>
        <?php endif; ?>
        <script src="../views/js/validateForm.js"></script>
        <div class="dashboard-form">
            <form method="post" action="change_password.php" onsubmit="return validateChangePasswordForm()">
                <div id="error_messages"></div>
                <table>
                    <tr>
                        <td><Label>Current Password:</Label></td>
                        <td><input type="password" name="current_password"></td>
                    </tr>
                    <tr>
                        <td><label>New Password:</label></td>
                        <td><input type="password" name="new_password"></td>
                    </tr>
                    <tr>
                        <td><label>Confirm New Password:</label></td>
                        <td><input type="password" name="confirm_password"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2" align='center'>
                            <input type="submit" value="Change Password">
                            <input type="reset" value="Reset">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </td>
</tr>

<?php include '../views/footer.php'; ?>