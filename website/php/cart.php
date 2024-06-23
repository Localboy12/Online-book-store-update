<?php
session_start();
if (!isset($_SESSION['Email'])) {
    header("Location: sign-in.php");
    exit(); 
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'remove_from_cart') {
    $book_id = $_POST['book_id'];
    foreach ($_SESSION['cart'] as $key => $cart_item) {
        if ($cart_item['id'] == $book_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array
    header("Location: cart.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="shortcut icon" href="../images/open-book.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&display=swap">
    <link rel="stylesheet" href="../css/webstyle.css">
</head>
<body>
    <section class="cart">
        <h1 class="heading"><span>Your Cart</span></h1>
        <div class="cart-container">
            <?php
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                $subtotal = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $subtotal += floatval(str_replace('₹', '', $item['price'])) * $item['quantity'];
                    ?>
                    <div class="cart-item">
                        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                        <div class="cart-item-details">
                            <h3><?php echo $item['title']; ?></h3>
                            <p><?php echo $item['author']; ?></p>
                            <div class="price"><?php echo $item['price']; ?></div>
                            <div class="quantity">
                                <input type="number" value="<?php echo $item['quantity']; ?>" min="1" class="quantity-input" data-book-id="<?php echo $item['id']; ?>">
                            </div>
                            <form action="cart.php" method="post" style="display:inline;">
                                <input type="hidden" name="action" value="remove_from_cart">
                                <input type="hidden" name="book_id" value="<?php echo $item['id']; ?>">
                                <button type="submit" class="btn">Remove</button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="cart-summary">
                    <h3>Summary</h3>
                    <p>Subtotal: ₹<?php echo number_format($subtotal, 2); ?></p>
                    <p>Shipping: ₹5.00</p>
                    <p class="total">Total: ₹<?php echo number_format($subtotal + 5, 2); ?></p>
                    <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
                </div>
                <?php
            } else {
                echo "<p>Your cart is empty.</p>";
            }
            ?>
        </div>
    </section>
    <div class="row">
        <div class="content">
            <a href="index.php" class="btn">Home</a>
        </div>
    </div>
    <script>
        document.querySelectorAll('.quantity-input').forEach(function(input) {
            input.addEventListener('change', function() {
                var bookId = this.getAttribute('data-book-id');
                var newQuantity = this.value;
                fetch('update_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({book_id: bookId, quantity: newQuantity})
                }).then(function(response) {
                    return response.json();
                }).then(function(data) {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert('Failed to update quantity');
                    }
                });
            });
        });
    </script>
</body>
</html>