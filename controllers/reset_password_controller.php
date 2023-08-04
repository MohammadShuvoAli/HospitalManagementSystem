<?php
// Initialize variables
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_password = sanitize($_POST["new_password"]);
    $confirm_password = sanitize($_POST["confirm_password"]);
    // Validate password
    if (empty($new_password)) {
        $new_password_err = "Please enter the new password.";
    } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $new_password)) {
        $new_password_err = "Password must contain one uppercase & lowercase letter, 
                        <br> one digit & special character and at least 8 character long.";
    }

    // Validate confirm password
    if (empty($confirm_password)) {
        $confirm_password_err = "Please enter confirm the password.";
    } elseif ($new_password != $confirm_password) {
        $confirm_password_err = "New password and Confirm password do not match.";
    }
    // Check for input errors before updating the password
    if (empty($new_password_err) && empty($confirm_password_err)) {
        // Prepare an update statement
        $sql = "UPDATE User SET password = :password WHERE user_id = :user_id";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":user_id", $param_user_id, PDO::PARAM_INT);

            // Set parameters
            $param_password = $new_password;
            $param_user_id = $token_data["user_id"];

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Delete the reset token from the PasswordResetToken table
                $stmt = $pdo->prepare("DELETE FROM PasswordResetToken WHERE token = :token");
                $stmt->bindParam(':token', $token);
                $stmt->execute();
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        unset($stmt);
    }
}
?>