<?php
require '../controllers/check_doctor_session.php';
require '../models/add_patient_model.php';
require '../controllers/add_patient_controller.php';
require '../models/config.php';
include '../views/header.php';
include '../views/sidebar.php';
?>
<td width="80%" valign="top">
    <h2 align='center'>Add Patient</h2>
    <script src="../views/js/validateForm.js"></script>
    <div class="dashboard-form">
        <form method="post" onsubmit="return validateAddPatientForm()">
            <div id="error_messages"></div>
            <table align='center'>
                <table align='center'>
                    <tr>
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
                    </tr>
                    <tr>
                        <td><label for="first_name">First Name:</label></td>
                        <td><input type="text" name="first_name" id="first_name" value="<?php echo $first_name ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="last_name">Last Name:</label></td>
                        <td><input type="text" name="last_name" id="last_name" value="<?php echo $last_name ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="date_of_birth">Date of Birth:</label></td>
                        <td><input type="date" name="date_of_birth" id="date_of_birth" value="<?php echo $date_of_birth ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="gender">Gender:</label></td>
                        <td>
                            <input type="radio" name="gender" id="gender_male" value="male" <?php if ($gender == 'male')
                                                                                                echo 'checked' ?>> Male
                            <input type="radio" name="gender" id="gender_female" value="female" <?php if ($gender == 'female')
                                                                                                    echo 'checked' ?>> Female
                            <input type="radio" name="gender" id="gender_other" value="other" <?php if ($gender == 'other')
                                                                                                    echo 'checked' ?>> Other
                        </td>
                    </tr>
                    <tr>
                        <td><label for="address">Address:</label></td>
                        <td><textarea name="address" id="address"><?php echo $address ?></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="phone">Phone:</label></td>
                        <td><input type="tel" name="phone" id="phone" pattern="[0-9]*" value="<?php echo $phone ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" name="email" id="email" value="<?php echo $email ?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2" align="center">
                            <input type="submit" name="submit" value="Add Patient">
                            <input type="reset" value="Reset">
                        </td>
                    </tr>
                </table>
        </form>
    </div>
</td>
<?php
include '../views/footer.php';
?>