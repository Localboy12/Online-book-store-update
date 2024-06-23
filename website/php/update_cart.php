<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $book_id = $data['book_id'];
    $quantity = $data['quantity'];
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['id'] == $book_id) {
            $cart_item['quantity'] = $quantity;
            break;
        }
    }
    echo json_encode(['success' => true]);
}
?>