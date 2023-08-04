<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    // If user is not logged in or not a doctor, redirect to login page
    header('Location: login.php');
    exit();
}
include '../controllers/admin_dashboard_controller.php';
include '../views/header.php';
?>

<td width="80%" valign="top">
    <h2 align='center'>Leave Applications</h2>
    <form method="post" action="">
        <table align='center' border="1">
            <tr>
                <th>Leave ID</th>
                <th>Reason for Leave</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Medical Document</th>
                <th>Status</th>
            </tr>
            <?php foreach ($leave_applications as $leave_application): ?>
                <tr>
                    <td>
                        <?= $leave_application['leave_id'] ?>
                    </td>
                    <td>
                        <?= ucfirst($leave_application['reason_for_leave'])?>
                    </td>
                    <td>
                        <?= date('d F Y', strtotime($leave_application['start_date'])) ?>
                    </td>
                    <td>
                        <?= date('d F Y', strtotime($leave_application['end_date'])) ?>
                    </td>
                    <td>
                        <?php if ($leave_application['medical_document']): ?>
                            <a href="uploads/<?= $leave_application['medical_document'] ?>" target="_blank"><?= $leave_application['medical_document'] ?></a>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                    <td>
                        <?= ucfirst($leave_application['leave_status'])?>
                    </td>
                    <td>
                        <input type="hidden" name="leave_id" value="<?= $leave_application['leave_id'] ?>">
                        <input type="submit" name="approve" value="Approve"
                            onclick="return confirm('Are you sure you want to Approve this Application?');">
                        <input type="submit" name="reject" value="Reject"
                            onclick="return confirm('Are you sure you want to Reject this Application?');">
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </form>

    <?php include '../views/footer.php' ?>