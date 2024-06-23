<?php
session_start();
// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin-login.php");
    exit();
}
// Database connection (replace with your credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_bookstore";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
// Fetch all books from the database
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
$books = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}
// Handle adding a new book
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'add_book') {
    $title = htmlspecialchars($_POST['title']);
    $author = htmlspecialchars($_POST['author']);
    $price = htmlspecialchars($_POST['price']);
    $description = htmlspecialchars($_POST['description']);
    $image_url = htmlspecialchars($_POST['image_url']);
    $stmt = $conn->prepare("INSERT INTO books (title, author, price, description, image_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $title, $author, $price, $description, $image_url);
    if ($stmt->execute()) {
        header("Location: admin-dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
// Handle deleting a book
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete_book') {
    $book_id = intval($_POST['book_id']);
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $book_id);
    if ($stmt->execute()) {
        header("Location: admin-dashboard.php");
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        :root {
            --green: linear-gradient(90deg, rgba(162,161,227,1) 0%, rgba(140,25,150,1) 100%);
            --dark-color: rgb(162,161,227);
            --black: #444;
            --light-color: #666;
            --border: .1rem solid rgba(0, 0, 0, 0.196);
            --border-hover: .1rem solid var(--black);
            --box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
        }
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
            text-transform: capitalize;
            transition: all .2s linear;
        }
        body {
            background: #f5f5f5;
            color: var(--black);
        }
        .dashboard-container {
            max-width: 1200px;
            margin: auto;
            padding: 2rem;
            background: #fff;
            box-shadow: var(--box-shadow);
            border-radius: 1rem;
            margin-top: 10rem;
        }
        h2 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 3rem;
            color: var(--black);
        }
        .add-book,
        .book-list {
            margin-bottom: 3rem;
        }
        .add-book h3,
        .book-list h3 {
            font-size: 2.5rem;
            color: var(--black);
            margin-bottom: 1.5rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            font-size: 1.4rem;
            margin-bottom: .5rem;
            color: var(--black);
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 1rem;
            border: var(--border);
            border-radius: .5rem;
            background: #f9f9f9;
            font-size: 1.4rem;
            color: var(--black);
        }
        .form-group input:focus,
        .form-group textarea:focus {
            border: var(--border-hover);
        }
        button {
            display: inline-block;
            padding: 1rem 2rem;
            background: var(--green);
            color: #fff;
            border-radius: .5rem;
            cursor: pointer;
            font-size: 1.6rem;
            box-shadow: var(--box-shadow);
            transition: background .3s;
        }
        button:hover {
            background: var(--dark-color);
        }
        .book-list ul {
            list-style: none;
        }
        .book-list li {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1rem;
            background: #f9f9f9;
            border: var(--border);
            border-radius: .5rem;
        }
        .book-list li div {
            margin-right: 2rem;
        }
        .book-list img {
            width: 100px;
            height: auto;
            border-radius: .5rem;
        }
        .book-list h4 {
            font-size: 2rem;
            color: var(--black);
            margin-bottom: .5rem;
        }
        .book-list p {
            font-size: 1.4rem;
            color: var(--light-color);
            margin-bottom: .5rem;
        }
        .logout a {
            display: inline-block;
            margin-top: 2rem;
            font-size: 1.6rem;
            color: var(--black);
            text-decoration: none;
            border: var(--border);
            padding: 1rem 2rem;
            border-radius: .5rem;
            transition: background .3s, color .3s;
        }
        .logout a:hover {
            background: var(--black);
            color: #fff;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-1">
            <a href="#" class="logo"><i class="fas fa-book"></i> BookHeaven </a>
        </div>
    </header>
    <div class="dashboard-container">
        <h2>Admin Dashboard</h2>
        <!-- Add Book Form -->
        <div class="add-book">
            <h3>Add New Book</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="action" value="add_book">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" required>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image_url">Image URL:</label>
                    <input type="text" id="image_url" name="image_url" required>
                </div>
                <button type="submit">Add Book</button>
            </form>
        </div>
        <!-- List of Books -->
        <div class="book-list">
            <h3>Manage Books</h3>
            <ul>
                <?php foreach ($books as $book) { ?>
                    <li>
                        <div>
                            <img src="<?php echo htmlspecialchars($book['image_url']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>" style="width: 100px; height: auto;">
                        </div>
                        <div>
                            <h4><?php echo htmlspecialchars($book['title']); ?></h4>
                            <p>Author: <?php echo htmlspecialchars($book['author']); ?></p>
                            <p>Price: <?php echo htmlspecialchars($book['price']); ?></p>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="action" value="delete_book">
                                <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                            </form>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <!-- Logout -->
        <div class="logout">
            <a href="admin-logout.php">Logout</a>
        </div>
    </div>
</body>
</html>