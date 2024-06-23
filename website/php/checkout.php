<?php
session_start();
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the payment (this is a placeholder - you would integrate with a payment gateway here)
    $cardName = $_POST['card_name'];
    $cardNumber = $_POST['card_number'];
    $expiryDate = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];
    // Basic validation (add more robust validation as needed)
    if (empty($cardName) || empty($cardNumber) || empty($expiryDate) || empty($cvv)) {
        $error = "All fields are required.";
    } else {
        // Assuming payment is processed successfully
        unset($_SESSION['cart']);
        header("Location: success.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="shortcut icon" href="../images/open-book.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&display=swap">
    <link rel="stylesheet" href="../css/webstyle.css">

</head>
<body>
    <section class="checkout">
        <h1 class="heading"><span>Checkout</span></h1>
        <div class="cart-container">
            <?php
            $subtotal = 0;
            foreach ($_SESSION['cart'] as $item) {
                // Ensure $item['price'] is numeric before calculations
                $price = floatval(str_replace('₹', '', $item['price']));
                $subtotal += $price * $item['quantity'];
                ?>
                <div class="cart-item">
                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                    <div class="cart-item-details">
                        <h3><?php echo $item['title']; ?></h3>
                        <p><?php echo $item['author']; ?></p>
                        <div class="price">₹<?php echo number_format($price, 2); ?></div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="cart-summary">
            <h3>Summary</h3>
            <p>Subtotal: ₹<?php echo number_format($subtotal, 2); ?></p>
            <p>Shipping: ₹5.00</p>
            <p class="total">Total: ₹<?php echo number_format($subtotal + 5, 2); ?></p>
        </div>
        <?php
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
        <form action="checkout.php" method="post" class="checkout-form">
            <h3>Payment Information</h3>
            <div class="form-group">
                <label for="card-name">Name on Card</label>
                <input type="text" id="card-name" name="card_name" placeholder="Enter Your Name" required>
            </div>
            <div class="form-group">
                <label for="card-number">Card Number</label>
                <input type="text" id="card-number" name="card_number" placeholder="1234 5678 9123 4567" required>
            </div>
            <div class="form-group">
                <label for="expiry-date">Expiry Date (MM/YY)</label>
                <input type="text" id="expiry-date" name="expiry_date" placeholder="01/01" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="number" id="cvv" name="cvv" placeholder="123" required>
            </div>
            <button type="submit" class="btn">Proceed to Payment</button>
        </form>
    </section>
    <div class="row">
        <div class="content">
            <!-- <a href="index.php" class="btn">Home</a> -->
            <a href="cart.php" class="btn">Cart</a>
        </div>
    </div>
</body>
</html>
