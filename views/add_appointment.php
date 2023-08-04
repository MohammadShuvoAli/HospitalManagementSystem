<?php
require '../controllers/check_doctor_session.php';
require '../models/add_appointment_model.php';
require '../controllers/add_appointment_controller.php';
require '../models/config.php';
include '../views/header.php';
include '../views/sidebar.php';
?>

<td style="width: 80%; vertical-align: top;">
    <h2 align='center'>Schedule Appointment</h2>
    <script src="../views/js/validateForm.js"></script>
    <div class="dashboard-form">
        <form method="post" action=<?php echo sanitize($_SERVER["PHP_SELF"]); ?> onsubmit="return validateAddAppointmentForm();">
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
                            </p class="error-message">
                        <?php endif; ?>
                    </td>
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
                    <td><label for="appointment_date">Appointment Date:</label></td>
                    <td><input type="date" name="appointment_date" id="appointment_date" value="<?php echo $appointment_date; ?>" /></td>
                </tr>
                <tr>
                    <td><label for="appointment_time">Appointment Time:</label></td>
                    <td><input type="time" name="appointment_time" id="appointment_time" value="<?php echo $appointment_time; ?>" /></td>
                </tr>
                <tr>
                    <td><input type="hidden" name="appointment_status" value="<?php echo $appointment_status; ?>" />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" align="center">
                        <input type="submit" name="submit" value="Schedule Appointment">
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