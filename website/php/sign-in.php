<?php
session_start();
$server_name = "localhost";
$username = "root";
$password = "";
$database_name = "online_bookstore";
$conn = mysqli_connect($server_name, $username, $password, $database_name);
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $Password = mysqli_real_escape_string($conn, $_POST['Password']);
    if (!empty($Email) && !empty($Password) && !is_numeric($Email)) {
        $query = "SELECT * FROM signup_data WHERE Email = '$Email' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if ($Password == $user_data['Password']) {
                    $_SESSION['user_name'] = $user_data['Username']; // Assuming 'Username' is a column in your table
                    $_SESSION['Email'] = $user_data['Email'];
                    header("Location: index.php");
                    die();
                } else {
                    echo "<script type='text/javascript'>alert('Wrong username or password')</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('User not found')</script>";
            }
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }
    } else {
        echo "<script type='text/javascript'>alert('Invalid email or password')</script>";
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signin-form</title>
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
				--dark-color:rgb(142, 86, 147) ;
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
			.login-form-container {
				max-width: 400px;
				margin: 50px auto;
				padding: 20px;
				background: #F1F1F1;
				border-radius: 10px;
				box-shadow: var(--box-shadow);
			}
			/* Form Styles */
			.login-form-container form {
				text-align: center;
			}
			.login-form-container h2 {
				margin-bottom: 20px;
				color: var(--dark-color);
				font-style: italic;
			}
			.login-form-container span {
				display: block;
				text-align: left;
				margin-top: 10px;
				color: var(--dark-color);
			}
			.login-form-container .box {
				width: 100%;
				padding: 10px;
				margin: 10px 0;
				border: var(--border);
				border-radius: 5px;
			}
			.login-form-container .checkbox {
				text-align: left;
				margin-bottom: 10px;
			}
			.login-form-container .checkbox input[type="checkbox"] {
				margin-right: 10px;
			}
			.login-form-container .checkbox label {
				color: var(--dark-color);
			}
			.login-form-container .btn {
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
			.login-form-container .btn:hover {
				background: rgba(140, 25, 150, 0.8);
			}
			.login-form-container p i {
				margin-top: 10px;
				color:var(--black);
			}
			.login-form-container p i a {
				color: blue;
			}
	</style>
</head>
<body>
        <header class="header">
            <div class="header-1">
                <a href="#" class="logo"><i class="fas fa-book"></i> BookHeaven </a>
            </div>
        </header>
		<div class="login-form-container">
			<form action="sign-in.php" method="post">
					<h2>Sign In</h2>
					<span>Username</span>
					<input type="email" name="Email" class="box" placeholder="enter your email" id="" required>
					<span>Password</span>
					<input type="password" name="Password" class="box" placeholder="enter your password" id="" required>
					<div class="checkbox">
						<input type="checkbox" name="" id="remember-me">
						<label for="remember-me"> remember me</label>
					</div>
					<input type="submit" value="sign in" class="btn">
					<p><i>forget password ? <a href="forget.php">click here</a></i></p>
					<p><i>dont't have an account ?  <a href="sign-up.php">create one</a></i></p>
			</form>
		</div>
</body>
</html>