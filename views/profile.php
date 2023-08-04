<?php
require '../controllers/check_doctor_session.php';
include '../views/header.php';
require '../models/config.php';

$update_success = false; // variable to check if update was successful

try {
  // Retrieve user information from the user table
  $username = $_SESSION["username"];
  $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
  $stmt->bindParam(":username", $username);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $user_id = $row["user_id"];
  $email = $row["email"];
  $role = $row["role"];

  // Retrieve additional information from the admin or doctor or receptionist table based on the role
  $stmt = $pdo->prepare("SELECT * FROM doctor WHERE user_id = :user_id");
  $stmt->bindParam(":user_id", $user_id);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $first_name = $row["first_name"];
  $last_name = $row["last_name"];
  $date_of_birth = $row["date_of_birth"];
  $gender = $row["gender"];
  $address = $row["address"];
  $phone = $row["phone"];
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

// Update user information if form is submitted
if (isset($_POST['update'])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $date_of_birth = $_POST['date_of_birth'];
  $gender = $_POST['gender'];
  $address = $_POST['address'];

  // Prepare the update statement based on the role
  $stmt = $pdo->prepare("UPDATE doctor SET first_name=:first_name, last_name=:last_name, date_of_birth=:date_of_birth, gender=:gender, address=:address, phone=:phone WHERE user_id=:user_id");
  $stmt->bindParam(":phone", $phone);

  // Update the email field in the user table
  $stmt_user = $pdo->prepare("UPDATE user SET email=:email WHERE user_id=:user_id");
  $stmt_user->bindParam(":user_id", $user_id);
  $stmt_user->bindParam(":email", $email);
  $stmt_user->execute();

  // Bind the parameters and execute the update statement
  $stmt->bindParam(":first_name", $first_name);
  $stmt->bindParam(":last_name", $last_name);
  $stmt->bindParam(":date_of_birth", $date_of_birth);
  $stmt->bindParam(":gender", $gender);
  $stmt->bindParam(":address", $address);
  $stmt->bindParam(":user_id", $user_id);

  if ($stmt->execute()) {
    $update_success = true;
  }
}
?>
<tr>
  <td colspan="2">
    <h2 align='center'>View & Update Profile</h2>
  </td>
</tr>
<tr>
  <td align='center'>
    <div class="dashboard-form">
      <form method="post">
        <table>
          <?php if ($update_success) { // Show success message if update was successful 
          ?>
            <tr>
              <td colspan='2' align='center'>
                <div class="success-message">
                  <p>Profile updated successfully!</p>
                </div>
              </td>
            </tr>
          <?php } ?>
          <tr>
            <td><label for="username">Username:</label></td>
            <td><input type="text" id="username" name="username" value="<?php echo $username; ?>" disabled></td>
          </tr>
          <tr>
            <td><label for="first_name">First Name:</label></td>
            <td><input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>" required></td>
          </tr>
          <tr>
            <td><label for="last_name">Last Name:</label></td>
            <td><input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>" required></td>
          </tr>
          <tr>
            <td><label for="email">Email:</label></td>
            <td><input type="email" name="email" value="<?php echo $email; ?>" required></td>
          </tr>

          <tr>
            <td><label for="date_of_birth">Date of Birth:</label></td>
            <td><input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo $date_of_birth; ?>" required>
            </td>
          </tr>
          <tr>
            <td><label>Gender:</label></td>
            <td>
              <input type="radio" id="male" name="gender" value="male" <?php if ($gender == "male")
                                                                          echo "checked"; ?>> Male
              <input type="radio" id="female" name="gender" value="female" <?php if ($gender == "female")
                                                                              echo "checked"; ?>> Female
              <input type="radio" id="others" name="gender" value="others" <?php if ($gender == "others")
                                                                              echo "checked"; ?>> Other
            </td>
          </tr>
          <tr>
            <td><label for="address">Address</label></td>
            <td><textarea id="address" name="address" required><?php echo $address; ?></textarea></td>
          </tr>
          <tr>
            <td><label for="phone">Phone</label></td>
            <td><input type="tel" id="phone" name="phone" pattern="[0-9]*" value="<?php echo $phone; ?>" required></td>
          </tr>
        </table>
        <input type="submit" name="update" value="Update">
      </form>
    </div>
  </td>
</tr>
<?php include 'footer.php'; ?>