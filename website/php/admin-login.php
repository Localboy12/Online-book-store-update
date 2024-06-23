<?php
session_start();
// Check if admin is already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin-dashboard.php");
    exit();
}
// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Authenticate admin (dummy credentials for example)
    $admin_username = "userone";
    $admin_password = "userone123";
    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin-dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="webstyle.css">
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
			.login-form-container .checkbox span {
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
        <h2>Admin Login</h2>
        <?php if (isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <span >Username:</span>
                <input type="text" id="username" class="box" name="username" placeholder="enter your email" required>
            </div>
            <div class="form-group">
                <span for="password">Password:</span>
                <input type="password" id="password" class="box" name="password" placeholder="enter your password" required>
            </div>
            <button type="submit"  class="btn">Login</button>
        </form>
    </div>
</body>
</html>