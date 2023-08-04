<?php
require '../controllers/check_doctor_session.php';
require '../models/add_test_model.php';
require '../controllers/add_test_controller.php';
include '../views/header.php';
include '../views/sidebar.php';
?>

<td width="80%" valign="top">
    <h2 align='center'>Add Test for Patient</h2>
    <script src="../views/js/validateForm.js"></script>
    <div class="dashboard-form">
        <form method="post" onsubmit="return validateAddTestForm()">
            <div id="error_messages"></div>
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
                    <td><label for="patient_id">Patient Name:</label></td>
                    <td><select name="patient_id" id="patient_id">
                            <option value="">-Select Patient-</option>
                            <?php foreach ($patients as $patient) : ?>
                                <option value="<?php echo $patient['patient_id']; ?>" <?php if ($patient_id == $patient['patient_id'])
                                                                                            echo 'selected="selected"'; ?>><?php echo $patient['first_name'] . ' ' . $patient['last_name']; ?></option>
                            <?php endforeach; ?>
                        </select></td>
                </tr>
                <tr>
                    <td><label for="test_name">Test Name:</label></td>
                    <td><input type="text" name="test_name" id="test_name" value="<?php echo $test_name; ?>" /></td>
                </tr>
                <tr>
                    <td><label for="test_date">Test Date:</label></td>
                    <td><input type="date" name="test_date" id="test_date" value="<?php echo $test_date; ?>" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" align="center"><input type="submit" name="submit" value="Add Test">
                        <input type="reset" value="Reset">
                    </td>
                </tr>
            </table>
        </form>
</td>
<?php include '../views/footer.php'; ?>