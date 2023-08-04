<?php 
require '../controllers/check_doctor_session.php';
require '../models/doctor_dashboard_model.php';
require '../controllers/doctor_dashboard_controller.php';
include '../views/header.php';
include '../views/sidebar.php';
?>

<td width="80%" valign="top" align="center">
    <h2>Welcome to the Doctor Dashboard!</h2>
    <p align="center">Please select an option from the sidebar to view functionality.</p>
    <table align='center' class="dashboard-table">
        <tr>
            <th>
                <h3> Total Patients </h3>
            </th>
            <th>
                <h3> Total Appointments </h3>
            </th>
            <th>
                <h3> Pending Appointments </h3>
            </th>
            <th>
                <h3> Total Doctors </h3>
            </th>
        </tr>
        <tr>
            <td>
                <h2 align='center'>
                    <?php echo $total_patients; ?>
                </h2>
            </td>
            <td>
                <h2 align='center'>
                    <?php echo $total_appointments; ?>
                </h2>
            </td>
            <td>
                <h2 align='center'>
                    <?php echo $pending_appointments; ?>
                </h2>
            </td>
            <td>
                <h2 align='center'>
                    <?php echo $total_doctors; ?>
                </h2>
            </td>
        </tr>
    </table>
</td>
</tr>

<?php include '../views/footer.php'; ?>
