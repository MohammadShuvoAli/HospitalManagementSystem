<?php
require '../controllers/check_doctor_session.php';
require '../models/edit_appointment_model.php';
require '../controllers/edit_appointment_controller.php';
include '../views/header.php';
include '../views/sidebar.php';
?>

<td width="80%" valign="top">
    <h2 align='center'>Edit Appointment Details</h2>
    <div class="dashboard-form">
        <form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
            <table align="center">
                <tr>
                    <td><input type="hidden" name="appointment_id" value="<?php echo $appointment['appointment_id']; ?>" readonly></td>
                </tr>
                <tr>
                    <td><input type="hidden" name="patient_id" value="<?php echo $appointment['patient_id']; ?>" readonly></td>
                </tr>
                <tr>

                    <td><input type="hidden" name="doctor_id" value="<?php echo $appointment['doctor_id']; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td> <label for="appointment_date">Appointment Date:</label></td>
                    <td><input type="date" name="appointment_date" value="<?php echo $appointment['appointment_date']; ?>"></td>
                </tr>
                <tr>
                    <td> <label for="appointment_time">Appointment Time:</label></td>
                    <td><input type="time" name="appointment_time" value="<?php echo $appointment['appointment_time']; ?>"></td>
                </tr>
                <tr>
                    <td> <label for="appointment_status">Appointment Status:</label></td>
                    <td><input type="text" name="appointment_status" value="<?php echo $appointment['appointment_status']; ?>" disabled></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" align="center">
                        <input type="submit" name="update" value="Update">
                        <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you want to delete this appointment?');">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" align="center">
                        <input type="submit" name="complete" value="Complete Appointment" onclick="return confirm('Done appointment?');">
                        <input type="submit" name="cancel" value="Cancel Appointment" onclick="return confirm('Are you sure you want to cancel this appointment?');">
                    </td>
                </tr>
            </table>
            <br>
        </form>
    </div>
</td>
</tr>
<?php include '../views/footer.php'; ?>