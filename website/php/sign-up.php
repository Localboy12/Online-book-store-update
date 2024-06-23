<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup-form</title>
	<link rel="shortcut icon" href="../images/open-book.png" type="image/png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">	
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
			<form action="sign-up.php" method="post">
				<h2>Sign Up</h2>
				<span>User Name</span>
				<input type="text" name="Username" class="box" placeholder="Enter your User-Name" id="full_name" maxlength="20" pattern="^\S+$" title="No spaces allowed" required>
				<span>Full Name</span>
				<input type="text" name="Fullname" class="box" placeholder="Enter your Full Name" id="full_name" maxlength="25" required>
				<span>Email</span>
				<input type="email" name="Email" class="box" placeholder="Enter your email" id="email" maxlength="35" pattern="^\S+$" title="No spaces allowed" required>
				<span>Phone</span>
				<input type="tel" name="Phone" class="box" placeholder="Enter your phone number" id="phone" maxlength="10" pattern="[0-9]{10}" title="Please enter a 10-digit mobile number" required>
				<span>Password</span>
				<input type="password" name="Password" class="box" placeholder="Enter your password" id="password" maxlength="20" pattern=".{8,}" title="Password must be at least 8 characters long" required>
				<input type="submit" name="sign_up" value="Sign Up" class="btn">
				<p class="message"><i>Already have an account? <a href="sign-in.php">Sign in</a></i></p>
			</form>
			<p class="message"><i>People who use our service may have uploaded your contact information to BookHeaven. <a href="#">Learn more</a></i></p><br>
			<p class="message"><i>By singing, you agree to our <a href="#">Terms</a>,<a href="../html/help.html">Privacy policy</a> and <a href="#">Cookies Policy</a></i></p>
		</div>
		<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="online_bookstore";
$conn = mysqli_connect($server_name, $username, $password, $database_name);
if(!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
if(isset($_POST['sign_up'])) {
    $Username = mysqli_real_escape_string($conn, $_POST['Username']);
    $Fullname = mysqli_real_escape_string($conn, $_POST['Fullname']);
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $Phone = mysqli_real_escape_string($conn, $_POST['Phone']);
    $Password = mysqli_real_escape_string($conn, $_POST['Password']);
    $sql_query = "INSERT INTO signup_data (Username, Fullname, Email, Phone, Password)
                VALUES ('$Username', '$Fullname', '$Email', '$Phone', '$Password')";
    if (mysqli_query($conn, $sql_query)) {
        echo "<script type='text/javascript'>alert('Successfully registered')</script>";
    } else {
        echo "<script type='text/javascript'>alert('Enter valid information')</script>";
    }
    mysqli_close($conn);
}
?>
</body>
</html>