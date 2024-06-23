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
    $reviewText = mysqli_real_escape_string($conn, $_POST['reviewText']);
    $user_name = $_SESSION['user_name'];
    $bookId = mysqli_real_escape_string($conn, $_POST['bookId']);
    $query = "INSERT INTO reviews (user_name, book_id, review_text) VALUES ('$user_name', '$bookId', '$reviewText')";
    if (mysqli_query($conn, $query)) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
<html>
    <link rel="stylesheet" href="../css/style.css">
    <a href="index.php">Home</a>
</html>