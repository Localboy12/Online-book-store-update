<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&display=swap');
			/* Universal Styles */
			* {
				font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
				margin: 0;
				padding: 0;
				box-sizing: border-box;
				outline: none;
				border: none;
				text-decoration: none;
				transition: all .2s linear;
				transition: width none;
			}
			/* Root Variables */
			:root {
				--green: linear-gradient(90deg, rgba(162, 161, 227, 1) 0%, rgba(140, 25, 150, 1) 100%);
				--dark-color: rgb(142, 86, 147);
				--black: #444;
				--light-color: #666;
				--border: .1rem solid rgba(0, 0, 0, 0.196);
				--border-hover: .1rem solid var(--black);
				--box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
			}
			/* Header Styles */
			.header {
				background: var(--green);
				color: #fff;
				padding: 20px;
				text-align: center;
			}
			.header .logo {
				color: #fff;
				font-size: 24px;
				font-weight: bold;
			}
			/* Form Container Styles */
			.signup-form-container {
				max-width: 400px;
				margin: 50px auto;
				padding: 20px;
				background: #F1F1F1;
				border-radius: 10px;
				box-shadow: var(--box-shadow);
			}
			/* Form Styles */
			.signup-form-container form {
				text-align: center;
			}
			.signup-form-container h2 {
				margin-bottom: 20px;
				color: var(--dark-color);
				font-style: italic
			}
			.signup-form-container span {
				display: block;
				text-align: left;
				margin-top: 10px;
				color: var(--dark-color);
			}
			.signup-form-container .box {
				width: 100%;
				padding: 10px;
				margin: 10px 0;
				border: var(--border);
				border-radius: 5px;
			}
			.signup-form-container .btn {
				display: block;
				width: 100%;
				padding: 10px;
				margin-top: 20px;
				background: var(--green);
				color: #fff;
				border: none;
				border-radius: 5px;
				cursor: pointer;
			}
			.signup-form-container .btn:hover {
				background: rgba(140, 25, 150, 0.8);
			}
			.signup-form-container p {
				margin-top: 10px;
			}
			.signup-form-container p a {
				color: var(--green);
			}
			.message{
				font-size:14px;
				color:var(--black);
				text-align:center;
			}
			.message i a{
				color:blue;
			}
    </style>
</head>
<body>
  <header class="header">
    <div class="header-1">
      <a href="#" class="logo"><i class="fas fa-book"></i> BookHeaven </a>
    </div>
  </header>
  <div class="signup-form-container">
    <h2>Edit Profile</h2>
    <form action="profile.php" method="post">
	<p class="message"><i>Enter your email that you want to change details</i></p>
	<span>Email</span>
    <input type="email" name="Email" class="box" placeholder="Enter your email" id="email" value="<?php echo $_SESSION['Email']; ?>" disabled>
	<hr style="color: black;">
      <span>User Name</span>
      <input type="text" name="Username" class="box" placeholder="Enter your userName" id="full_name" value="<?php echo $_SESSION['user_name']; ?>">
      <span>Full Name</span>
      <input type="text" name="Fullname" class="box" placeholder="Enter your fullName" id="full_name">
      <span>Phone</span>
      <input type="tel" name="Phone" class="box" placeholder="Enter your phone number" id="phone">
      <span>Password</span>
      <input type="password" name="Current_Password" class="box" placeholder="Current Password" required>
      <span>New Password</span>
      <input type="password" name="New_Password" class="box" placeholder="Enter new password">
      <input type="submit" name="update_profile" value="Update Profile" class="btn">
    </form>
    <p class="message"><i>Return to <a href="http://localhost/website/html/help.html">Help</a></i></p>
  </div>
<?php
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $database_name = "online_bookstore";
    $conn = mysqli_connect($server_name, $username, $password, $database_name);
    // Check connection
    if (!$conn) {
      die("Connection Failed: " . mysqli_connect_error());
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Retrieve form data
      $Username = $_SESSION['user_name'];
      $Fullname = $_POST['Fullname'];
      $Phone = $_POST['Phone'];
      $Current_Password = $_POST['Current_Password'];
      $New_Password = $_POST['New_Password']; // Optional
	  $Email =  $_SESSION['Email'];
      // Validate current password before update
      $email = $_POST['Email']; // Used for password validation
      $query = "SELECT * FROM signup_data WHERE Email = '$Email' LIMIT 1";
      $result = mysqli_query($conn, $query);
      if ($result) {
        if (mysqli_num_rows($result) > 0) {
          $user_data = mysqli_fetch_assoc($result);
          if ($user_data['Password'] == $Current_Password) {
            // Update user details
            $update_query = "UPDATE signup_data SET Username = '$Username', Fullname = '$Fullname', Phone = '$Phone'";
            // Add new password if provided
            if (!empty($New_Password)) {
              $update_query .= ", Password = '$New_Password'";
            }
            $update_query .= " WHERE Email = '$Email'";
            if (mysqli_query($conn, $update_query)) {
              echo "<script type='text/javascript'>alert('Profile updated successfully!')</script>";
            } else {
              echo "Error updating profile: " . mysqli_error($conn);
            }
          } else {
            echo "<script type='text/javascript'>alert('Wrong current password')</script>";
          }
        } else {
          echo "<script type='text/javascript'>alert('User not found')</script>";
		}
	  }
	}
?>	
</body>
</html>
