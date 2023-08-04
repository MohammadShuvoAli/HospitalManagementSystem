<?php
include '../views/header.php';
?>
<tr>
    <td colspan="2">
        <h2 align='center'>Settings</h2>
    </td>
</tr>
<tr>
    <td align='center'>
        <div class="dashboard-form">
            <form method="post">
                <label for="mode" style="margin-right: 10px;"><b>Theme:</b></label>
                <select name="mode" id="mode" style="padding: 5px;">
                    <option value="light" <?php if (isset($_COOKIE['mode']) && $_COOKIE['mode'] == 'light') echo 'selected'; ?> style="background-color: #fff; color: #000;">Light</option>
                    <option value="dark" <?php if (isset($_COOKIE['mode']) && $_COOKIE['mode'] == 'dark') echo 'selected'; ?> style="background-color: #333; color: #fff;">Dark</option>
                </select>
                <input type="submit" value="Submit" style="margin-top: 7px; padding: 7px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">
            </form>
        </div>
    </td>
</tr>
<?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get selected mode from form data
    $mode = $_POST['mode'];

    // Set a cookie to remember the mode
    setcookie('mode', $mode, time() + (86400 * 30), "/"); // Cookie will expire in 30 days
}
?>

<?php include '../views/footer.php'; ?>