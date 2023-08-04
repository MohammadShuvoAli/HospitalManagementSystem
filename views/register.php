<?php
session_start();
include 'header.php';
// Include database configuration file
require "../models/config.php";
function sanitize($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
// Define variables and set to empty values
$usernameErr = $passwordErr = $emailErr = $roleErr = $firstNameErr = $lastNameErr = $dobErr = $genderErr = $addressErr = $phoneErr = "";
$username = $password = $email = $role = $firstName = $lastName = $dob = $gender = $address = $phone = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Validate username
  if (empty($_POST["username"])) {
    $usernameErr = "Username is required";
  } else {
    $username = sanitize($_POST["username"]);
    // Check if username already exists
    $stmt = $pdo->prepare("SELECT * FROM user WHERE username=:username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      $usernameErr = "Username already exists";
    }
  }
  // Validate password
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = sanitize($_POST["password"]);
    // check if password contains at least one uppercase letter, one lowercase letter, one digit, and one special character
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
      $passwordErr = "Password must contain
      <br> one uppercase & lowercase letter, 
      <br> one digit & special character
      <br> and at least 8 character long.";
    }
  }
  if (!empty($_POST["password"]) && $passwordErr == "") {
    $password = ($_POST["password"]);
  }
  // Validate email
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = sanitize($_POST["email"]);
    // Check if email already exists
    $stmt = $pdo->prepare("SELECT * FROM user WHERE email=:email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      $emailErr = "Email already exists";
    }
  }
  // Validate role
  if (empty($_POST["role"])) {
    $roleErr = "Role is required";
  } else {
    $role = sanitize($_POST["role"]);
  }
  // Validate first name
  if (empty($_POST["first_name"])) {
    $firstNameErr = "First name is required";
  } else {
    $firstName = sanitize($_POST["first_name"]);
  }
  // Validate last name
  if (empty($_POST["last_name"])) {
    $lastNameErr = "Last name is required";
  } else {
    $lastName = sanitize($_POST["last_name"]);
  }
  // Validate date of birth
  if (empty($_POST["date_of_birth"])) {
    $dobErr = "Date of birth is required";
  } else {
    $dob = sanitize($_POST["date_of_birth"]);
  }
  // Validate gender
  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = sanitize($_POST["gender"]);
  }
  // Validate address
  if (empty($_POST["address"])) {
    $addressErr = "Address is required";
  } else {
    $address = sanitize($_POST["address"]);
  }
  // Validate phone
  if (empty($_POST["phone"])) {
    $phoneErr = "Phone is required";
  } else {
    $phone = sanitize($_POST["phone"]);
  }
  // If no errors, insert data into user table and appropriate role table
  if (
    $usernameErr == "" && $passwordErr == "" && $emailErr == "" && $roleErr == "" && $firstNameErr == "" && $lastNameErr == "" && $dobErr == "" && $genderErr == "" && $addressErr == "" && $phoneErr == ""
  ) {
    // Insert data into user table
    $stmt = $pdo->prepare("INSERT INTO user (username, password, email, role) VALUES (:username, :password, :email, :role)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':role', $role);
    $stmt->execute();

    // Insert data into appropriate role table
    $user_id = $pdo->lastInsertId(); // Get last inserted user id

    switch ($role) {
      case "admin":
        $stmt = $pdo->prepare("INSERT INTO admin (user_id, first_name, last_name, date_of_birth, gender, address, phone) VALUES (:user_id, :first_name, :last_name, :date_of_birth, :gender, :address, :phone)");
        break;
      case "doctor":
        $stmt = $pdo->prepare("INSERT INTO doctor (user_id, first_name, last_name, date_of_birth, gender, address, phone) VALUES (:user_id, :first_name, :last_name, :date_of_birth, :gender, :address, :phone)");
        break;
      case "receptionist":
        $stmt = $pdo->prepare("INSERT INTO receptionist (user_id, first_name, last_name, date_of_birth, gender, address, phone) VALUES (:user_id, :first_name, :last_name, :date_of_birth, :gender, :address, :phone)");
        break;
    }

    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':date_of_birth', $dob);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phone', $phone);
    $stmt->execute();

    // Redirect to login page after successful registration
    header("Location: login.php");
    exit();
  }
}
?>
<tr>
  <td colspan="2">
    <h2 align='center'>Register</h2>
  </td>
</tr>
<tr>
  <td align='center'>
    <script src="../views/js/validateForm.js"></script>
    <div class="dashboard-form">
      <form method="post" action="<?php echo sanitize($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateRegisterForm();">
        <div id="error_messages"></div>
        <table>
          <tr>
            <td><label for="username">Username:</label></td>
            <td><input type="text" id="username" name="username" value="<?php echo $username; ?>">
            </td>
            <td></td>
            <td class="error-message">
              <?php echo $usernameErr; ?>
            </td>
          </tr>
          <tr>
            <td><label for="password">Password:</label></td>
            <td><input type="password" name="password" id="password">
            </td>
            <td></td>
            <td class="error-message">
              <?php echo $passwordErr; ?>
            </td>
          </tr>
          <tr>
            <td><label for="email">Email:</label></td>
            <td><input type="text" id="email" name="email" value="<?php echo $email; ?>">
            </td>
            <td></td>
            <td class="error-message">
              <?php echo $emailErr; ?>
            </td>
          </tr>
          <tr>
            <td><label for="role">Role:</label></td>
            <td>
              <select name="role" id="role">
                <option value="">Select a role</option>
                <option value="admin" <?php if ($role == 'admin')
                                        echo 'selected'; ?>>Admin</option>
                <option value="doctor" <?php if ($role == 'doctor')
                                          echo 'selected'; ?>>Doctor</option>
                <option value="receptionist" <?php if ($role == 'receptionist')
                                                echo 'selected'; ?>>Receptionist</option>
              </select>
            </td>
            <td></td>
            <td class="error-message">
              <?php echo $roleErr; ?>
            </td>
          </tr>
          <tr>
            <td><label for="first_name">First Name:</label></td>
            <td><input type="text" id="first_name" name="first_name" value="<?php echo $firstName; ?>">
            </td>
            <td></td>
            <td class="error-message">
              <?php echo $firstNameErr; ?>
            </td>
          </tr>
          <tr>
            <td><label for="last_name">Last Name:</label></td>
            <td>
              <input type="text" id="last_name" name="last_name" value="<?php echo $lastName; ?>">
            </td>
            <td></td>
            <td class="error-message">
              <?php echo $lastNameErr; ?>
            </td>
          </tr>
          <tr>
            <td><label for="date_of_birth">Date of Birth:</label></td>
            <td>
              <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo $dob; ?>">
            </td>
            <td></td>
            <td class="error-message">
              <?php echo $dobErr; ?>
            </td>
          </tr>
          <tr>
            <td>
              <label>Gender:</label>
            </td>
            <td>
              <input type="radio" id="male" name="gender" value="male" <?php if (isset($gender) && $gender == "male")
                                                                          echo "checked"; ?>> Male
              <input type="radio" id="female" name="gender" value="female" <?php if (isset($gender) && $gender == "female")
                                                                              echo "checked"; ?>> Female
              <input type="radio" id="other" name="gender" value="other" <?php if (isset($gender) && $gender == "other")
                                                                            echo "checked"; ?>> Other
            </td>
            <td></td>
            <td class="error-message">
              <?php echo $genderErr; ?>
            </td>
          </tr>
          <tr>
            <td><label for="address">Address:</label></td>
            <td>
              <textarea id="address" name="address"><?php echo $address; ?></textarea>
            </td>
            <td></td>
            <td class="error-message">
              <?php echo $addressErr; ?>
            </td>
          </tr>
          <tr>
            <td><label for="phone">Phone:</label></td>
            <td>
              <input type="tel" id="phone" name="phone" pattern="[0-9]*" value="<?php echo $phone; ?>">
            </td>
            <td></td>
            <td class="error-message">
              <?php echo $phoneErr; ?>
            </td>
          </tr>
        </table>
        <br>
        <input type="submit" value="Register">
        <input type="reset" value="Reset">
      </form>
    </div>
    <p align='center'>Already have an account? Click <a href="login.php">Here</a></p>
  </td>
</tr>
<?php
include 'footer.php';
?>