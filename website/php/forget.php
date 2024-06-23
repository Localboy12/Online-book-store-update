<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password Form</title>
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
        /* Style the signup form container */
        .signup-form-container {
            width: 400px; /* Adjust width as needed */
            margin: 50px auto; /* Center the form horizontally */
            padding: 30px;
            background-color: #f1f1f1;
            border-radius: 5px;
            box-shadow: var(--box-shadow);
        }
        /* Style the form title */
        .signup-form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: var(--dark-color);
        }
        /* Style the email label */
        .signup-form-container span {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: var(--dark-color);
        }
        /* Style the email input field */
        .signup-form-container input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 3px;
            font-size: 16px;
        }
        /* Style the email input field on hover */
        .signup-form-container input[type="email"]:hover {
            border: var(--border-hover);
        }
        /* Style the submit button */
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
            transition: 0.2s;
        }
        .signup-form-container .btn:hover {
            background: rgba(140, 25, 150, 0.8);
        }
        /* Style the message paragraph */
        .signup-form-container p.message {
            text-align: center;
            font-size: 14px;
            color: var(--dark-color);
            margin-top: 10px;
        }
        /* Style the links within the message */
        .signup-form-container p .message a {
            color: var(--green);
        }
        .signup-form-container p i a {
            color: blue;
        }
        /* Style the retrieved password display */
        .password-display {
            text-align: center;
            font-size: 16px;
            color: var(--dark-color);
            margin-top: 20px;
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
        <form action="" method="post">
            <h2>Forget Password</h2>
            <span>Email</span>
            <input type="email" name="Email" class="box" placeholder="Enter your email" id="email" required>
            <input type="submit" name="submit" value="Submit" class="btn">
            <p class="message"><i>Remember your password? <a href="sign-in.php">Sign in</a></i></p>
        </form>
        <p class="message"><i>By submitting, you agree to our <a href="#">Terms</a>, <a href="#">Privacy policy</a>, and <a href="#">Cookies Policy</a></i></p>
    </div>
<?php
        $server_name = "localhost";
        $username = "root";
        $password = "";
        $database_name = "online_bookstore";
        $conn = mysqli_connect($server_name, $username, $password, $database_name);
        if (!$conn) {
            die("Connection Failed: " . mysqli_connect_error());
        }
        if (isset($_POST['submit'])) {
            $Email = $_POST['Email'];
            $sql_query = "SELECT PASSWORD FROM `signup_data` WHERE Email = '$Email'";
            $result = mysqli_query($conn, $sql_query);
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $password = $row['PASSWORD'];
                echo "<p class='password-display'>Your password is: <strong>$password</strong></p>";
            } else {
                echo "<p class='password-display'>Invalid email address. Please try again.</p>";
            }
            mysqli_close($conn);
        }
        ?>
</body>
</html>