<?php
session_start(); // Start session

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    // If user is not logged in, redirect to login page
    header('Location: login.php');
    exit();
}
?>


<?php include 'header.php'; ?>

<tr>
    <td colspan="2">
        <h2 align = 'center'>Receptionist Dashboard</h2>
    </td>
</tr>
<tr>
    <td>
        <p>Welcome,
            <?php echo $_SESSION['username']; ?>!
        </p>
    </td>
    <td align="right">
        <a href="logout.php">Logout</a>
    </td>
</tr>

<?php include 'footer.php'; ?>