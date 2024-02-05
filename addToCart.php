<?php
// Start the session to access session variables
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve book details from the form
    $bookId = $_POST['book_id'];
    $title = $_POST['title'];
    $price = $_POST['price'];

    // Create a new cart item
    $cartItem = array(
        'book_id' => $bookId,
        'title' => $title,
        'price' => $price,
        'quantity' => 1 // You can set the initial quantity as needed
    );

    // Check if the cart session variable exists
    if (!isset($_SESSION['cart'])) {
        // If not, create an empty cart array
        $_SESSION['cart'] = array();
    }

    // Check if the book is already in the cart
    $bookInCart = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['book_id'] === $bookId) {
            // If the book is already in the cart, increment the quantity
            $item['quantity']++;
            $bookInCart = true;
            break;
        }
    }

    // If the book is not in the cart, add it as a new item
    if (!$bookInCart) {
        $_SESSION['cart'][] = $cartItem;
    }

    // Redirect back to the previous page or a confirmation page
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
} else {
    // If the form is not submitted, redirect to the homepage or an error page
    header("Location: index.php"); // Change "index.php" to your homepage or error page
    exit();
}
?>