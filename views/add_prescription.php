<?php
require '../controllers/check_doctor_session.php';
require '../models/add_prescription_model.php';
require '../controllers/add_prescription_controller.php';

require '../models/config.php';
include '../views/header.php';
include '../views/sidebar.php';
?>

<td width="80%" valign="top">
    <h2 align='center'>Add Prescription</h2>
    <script src="../views/js/validateForm.js"></script>
    <div class="dashboard-form">
        <form method="post" action=<?php echo sanitize($_SERVER["PHP_SELF"]); ?> onsubmit="return validateAddPrescriptionForm();">
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
                    <td></td>
                    <td>
                        <?php if (isset($message)) : ?>
                            <p class="error-message">
                                <?= $message ?>
                            </p>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><label for="appointment_id">Appointment :</label></td>
                    <td>
                        <select name="appointment_id" id="appointment_id">
                            <?php foreach ($appointments as $appointment) : ?>
                                <option value="<?php echo $appointment['appointment_id']; ?>" <?php if ($appointment_id == $appointment['appointment_id'])
                                                                                                    echo 'selected="selected"'; ?>>
                                    <?php echo 'Date: ' . $appointment['appointment_date'] . ' Time: ' . $appointment['appointment_time']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="patient_id">Patient Name:</label></td>
                    <td>
                        <select name="patient_id" id="patient_id">
                            <?php foreach ($patients as $patient) : ?>
                                <option value="<?php echo $patient['patient_id']; ?>" <?php if ($patient_id == $patient['patient_id'])
                                                                                            echo 'selected="selected"'; ?>>
                                    <?php echo $patient['first_name'] . ' ' . $patient['last_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="medicine_name">Medicine Name:</label></td>
                    <td><input type="text" name="medicine_name" id="medicine_name" value="<?php echo $medicine_name; ?>" /></td>
                </tr>
                <tr>
                    <td><label for="dosage">Dosage:</label></td>
                    <td><input type="text" name="dosage" id="dosage" value="<?php echo $dosage; ?>" /></td>
                </tr>
                <tr>
                    <td><label for="duration">Duration:</label></td>
                    <td><input type="text" name="duration" id="duration" value="<?php echo $duration; ?>" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" align="center">
                        <input type="submit" name="submit" value="Add Prescription">
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