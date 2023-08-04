<?php
require '../controllers/check_doctor_session.php';
require '../models/add_report_model.php';
require '../controllers/add_report_controller.php';
include '../views/header.php';
include '../views/sidebar.php';
?>

<td width="80%" valign="top">
    <h2 align='center'>Add Report</h2>
    <script src="../views/js/validateForm.js"></script>
    <div class="dashboard-form">
        <form method="post" onsubmit="return validateAddReportForm()">
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
                    <td><label for="report_date">Report Date:</label></td>
                    <td><input type="date" name="report_date" id="report_date" value=""></td>
                </tr>
                <tr>
                    <td><label for="report_details">Report Details:</label></td>
                    <td><textarea name="report_details" id="report_details"></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" align="center">
                        <input type="submit" name="submit" value="Add Report">
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