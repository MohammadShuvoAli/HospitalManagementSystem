<!DOCTYPE html>
<html lang="en">

<head>
	<title>Hospital Management System</title>
	<?php
		// Check if cookie is set
		if (isset($_COOKIE['mode'])) {
			// Get mode from cookie
			$mode = $_COOKIE['mode'];

			// Include the appropriate CSS file based on mode
			if ($mode == 'light') {
				echo '<link rel="stylesheet" href="../views/css/light_style.css">';
			} else if ($mode == 'dark') {
				echo '<link rel="stylesheet" href="../views/css/dark_style.css">';
			}
		} else {
			// Default to "light_style.css"
			echo '<link rel="stylesheet" href="../views/css/light_style.css">';
		}
	?>
</head>

<body>
	<table class="main_table" width="60%;" align='center'>
		<tr>
			<td colspan="4">
				<table width="100%;">
					<tr>
						<td width="100" height="40" align="center">
							<a href="index.php">
								<img src="../picture/logo.png" alt="HMS LOGO" width="60" height="60">
							</a>
						</td>
						<td align='right'>
							<nav style="text-align: right;">
								<?php
								if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'doctor') {
									// User is logged in as doctor
									$user_id = $_SESSION['user_id'];

									require "../models/config.php";

									//retrieve first name and last name from doctor table
									$stmt = $pdo->prepare("SELECT first_name, last_name FROM doctor WHERE user_id = :user_id");
									$stmt->bindParam(":user_id", $user_id);
									$stmt->execute();
									$doctor = $stmt->fetch(PDO::FETCH_ASSOC);

									// Check if doctor was found
									if ($doctor) {
										$fname = ucwords($doctor['first_name']);
										$lname = ucwords($doctor['last_name']);
										echo '<b>Welcome Back, ' . $fname . ' ' . $lname . ' !</b> &nbsp&nbsp&nbsp&nbsp';
										echo '<button><a href="doctor_dashboard.php">Home</a></button>';
										echo '<button><a href="profile.php">Profile</a></button>';
										echo '<button><a href="change_password.php">Change Password</a></button>';
										echo '<button><a href="../controllers/logout.php">Logout</a></button> &nbsp';
									}
								} else {
									// User is not logged in
									echo '<button><a href="index.php">Home</a></button>';
									echo '<button><a href="../views/about-us.php">About us</a></button>';
									echo '<button><a href="../views/services.php">Services</a></button>';
									echo '<button><a href="../views/settings.php">Settings</a></button>';
									echo '<button><a href="../views/login.php">Login</a></button> &nbsp';
								}
								?>
							</nav>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<h2 align='center'>Hospital Management System</h2>
						</td>
					</tr>
				</table>
			</td>
		</tr>