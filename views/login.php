<?php
session_start(); // Start session
require '../models/login_model.php';
require '../controllers/login_controller.php';

include '../views/header.php';
?>

<tr>
    <td colspan="2">
        <h2 align='center'>Login</h2>
    </td>
</tr>

<tr>
    <td colspan="2">
        <script src="../views/js/validateForm.js"></script>
        <div class="dashboard-form">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateLoginForm();">
                <div id="error_messages"></div>
                <?php if (isset($_SESSION['error_msg'])) : ?>
                    <p align='center' class="error-message">
                        <?php echo $_SESSION['error_msg']; ?>
                    </p>
                <?php endif; ?>
                <table align='center'>
                    <tr>
                        <td><label for="username">Username:</label></td>
                        <td><input type="text" name="username" id="username"></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" name="password" id="password"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2" align='center'>
                            <input type='checkbox' name='remember_me' value='1'><b> Remember Me</b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2" align='center'>
                            <input type="submit" name="submit" value="Login">
                            <input type="reset" value="Reset">
                        </td>
                    </tr>
                </table>
            </form>
            <p align='center'>Forget Password? Click <a href="forget_password.php">Here</a></p>
            <p align='center'>Don't have an account? Register <a href="register.php">Here</a></p>
    </td>
    </div>
</tr>
<?php include '../views/footer.php'; ?>
<?php unset($_SESSION['error_msg']); ?>