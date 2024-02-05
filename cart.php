<?php
    session_start();
if(!isset($_SESSION['login'])){
    header("location:clogin.php");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>cart</title>
</head>

<div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
        <li><a class="navbar-brand" href="customer.php">GrimBook</a><li>
        <li><a href="customer.php"><img src="home.png" alt="Logo"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;HOME</a></li>
        <li><a href="logout.php"><img src="book.png" alt="Logo"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp; Logout</a></li>
    </ul>
</div>
<body>

<br>
<br>
<section class="image-slider-container">
    <div class="image-slider-heading">
    <h2 class="image-slider-title">CART</h2>
        <div class="swiper-pagination"></div>
    </div>
    <div class="swiper" style="display: flex; align-items: center;">

<?php

include 'connection.php';

if (isset($_SESSION['user_id'])) {
    $customerId = $_SESSION['user_id'];
    $query = "SELECT items.id as item_id, items.title, items.isbn, items.author, items.genre, items.price,
                items.type, items.img, items.qty AS item_qty, cart.*
                FROM cart
                INNER JOIN items ON items.id = cart.book_id
                WHERE cart.c_id = $customerId";

        $run = mysqli_query($con, $query);

        if (!$run) {
            die('Error in SQL query: ' . mysqli_error($con));
        }
        $totalPrice = 0;
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
        while ($cartItem = mysqli_fetch_assoc($run)) {
            echo '<div class="swiper">'; 
            echo '<div class="swiper-row">';
            echo '<div class="swiper-slide">';
            echo '<div class="slide-con">';
            $titleWords = explode(' ', $cartItem['title']);
            $limitedTitle = implode(' ', array_slice($titleWords, 0, 3));
            $remainingContent = implode(' ', array_slice($titleWords, 3));
            echo '<img src="' . $cartItem['img'] . '" alt="Book Cover">';
            echo '<p class="overlay-text" title="' . $cartItem['title'] . '" style="color: white; font-size: 10px;">' . $limitedTitle . '<br>' . $remainingContent . '</p>';
            echo '<div class="slide-details">';
            echo '<div class="label">Title:</div>';
            echo '<div class="book-info">';
            echo '<span class="book-name" title="' . $cartItem['title'] . '">' . $cartItem['title'] . '</span>';
            echo '</div>';
            echo '<div class="label">Author:</div>';
            echo '<div class="book-info">';
            echo '<span class="author" title="' . $cartItem['author'] . '">' . $cartItem['author'] . '</span>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<div>';  
          
            echo '<div style="color: #888;">'; // Set text color to grey
            echo '<br>';
            echo '<br>';
            echo '<p>Genre: ' . $cartItem['genre'] . '</p>';
            echo '<p>Price: ' . $cartItem['price'] . '</p>';
            echo '<p>Type: ' . $cartItem['type'] . '</p>';
            echo '<form action="cart.php" method="post">';
            echo '<input type="hidden" name="item_id" value="' . $cartItem['item_id'] . '">';
            echo '<input type="hidden" name="max_qty" value="' . $cartItem['item_qty'] . '">';
            echo '<p class="quantity-container">';
            echo '  Quantity: ';
            echo '  <button type="submit" name="decrease_qty" value="' . $cartItem['item_id'] . '" class="quantity-btn">-</button>';
            echo '  <span class="quantity-display">' . $cartItem['qty'] . '</span>';
            echo '  <button type="submit" name="increase_qty" value="' . $cartItem['item_id'] . '" class="quantity-btn">+</button>';
            echo '  <button type="submit" name="remove_item" value="' . $cartItem['item_id'] . '" class="remove-btn">Remove</button>';
            echo '</p>';
            echo '</form>';
            $itemTotal = $cartItem['qty'] * $cartItem['price'];
            echo '<br>';
            echo '<br>';
            echo '<p>Total Price for Item: ' . $itemTotal . '</p>';
            echo '<br>';
            echo '<br>';
            echo '<br>';
            echo '<br>';
            echo '</div>';
            echo '</div>';
            
            $totalPrice += $itemTotal;
            echo '<br>';
            echo '<br>';
            echo '</div>';
            }
        
            mysqli_close($con);
            echo '<br>';
            echo '<br>';
            echo '<h1 style="color: #888;">Total Price for All Items: ' . $totalPrice . '</h1>';
            if ($totalPrice > 0) {
                echo '<form method="post" action="">';
                echo '<label style="color: #888;" for="shipping_address">Shipping Address:</label>';
                echo '<input type="text" id="shipping_address" name="shipping_address" required>';
                echo '<label style="color: #888;" for="order_date">Order Date:</label>';
                $currentDate = date("Y-m-d H:i:s"); 
                echo '<input type="text" id="order_date" name="order_date" value="' . $currentDate . '" readonly>';
                echo '<br>';
                echo '<br>';
                echo '<button type="submit" name="checkout" class="checkout-btn">Checkout</button>';
                echo '</form>';
            } else {
                echo '<p style="color: #888;">There are no items in the cart, so checkout is not available.</p>';
            }
        }   
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                include 'connection.php';
                $item_id = $_POST['item_id'];
                $max_qty = $_POST['max_qty'];
            
                if (isset($_POST['increase_qty'])) {
                    $query = "UPDATE cart SET qty = LEAST(qty + 1, $max_qty) WHERE c_id = $customerId AND book_id = $item_id";
                } elseif (isset($_POST['decrease_qty'])) {
                    $query = "UPDATE cart SET qty = GREATEST(qty - 1, 0) WHERE c_id = $customerId AND book_id = $item_id";
            
                } elseif (isset($_POST['remove_item'])) {
                    $removeItemId = $_POST['remove_item'];
                    $deleteQuery = "DELETE FROM cart WHERE c_id = $customerId AND book_id = $removeItemId";
                    mysqli_query($con, $deleteQuery);
                    
                }
                $result = mysqli_query($con, $query);
                if (isset($_POST['decrease_qty']) && $_POST['decrease_qty'] && mysqli_affected_rows($con) > 0) {
                    $deleteQuery = "DELETE FROM cart WHERE c_id = $customerId AND book_id = $item_id AND qty = 0";
                    mysqli_query($con, $deleteQuery);
                }
                if (isset($_POST['checkout'])) {
                    $date = date("Y-m-d H:i:s");
                    $cart_items = $_SESSION['cart'];
                    $ship_address = mysqli_real_escape_string($con, $_POST['shipping_address']);
                    $query_orders = "INSERT INTO orders (date, ship_address, c_id) VALUES ('$date', '$ship_address', '$customerId')";
                    $result_orders = mysqli_query($con, $query_orders);
                    $query_delete_cart = "SELECT * FROM cart WHERE c_id = $customerId";
                    $result_delete_cart = mysqli_query($con, $query_delete_cart);
                    
                    while ($cart_item = mysqli_fetch_assoc($result_delete_cart)) {
                        $book_id = $cart_item['book_id'];
                        $quantity = $cart_item['qty'];
                        $query_select_item = "SELECT * FROM items WHERE id = $book_id";
                        $result_select_item = mysqli_query($con, $query_select_item);
                    
                        if ($item = mysqli_fetch_assoc($result_select_item)) {
                            $new_quantity = $item['qty'] - $quantity;
                    
                            $query_update_items = "UPDATE items SET qty = $new_quantity WHERE id = $book_id";
                            $result_update_items = mysqli_query($con, $query_update_items);

                            $all = "SELECT * FROM orders";
                            $result_orders = mysqli_query($con, $all);
                            
                            if ($result_orders) {
                                $all_rows = mysqli_fetch_all($result_orders, MYSQLI_ASSOC);
                            
                                if (!empty($all_rows)) {
                                    $last_row = end($all_rows);
                                    $last_order_id = $last_row['id'];
            
                                    $query_order_items = "INSERT INTO ordered_items (o_id, i_id, qty) VALUES ('$last_order_id', '$book_id', '$quantity')";
                                    $result_order_items = mysqli_query($con, $query_order_items);
                            
                                    if ($result_order_items) {
                                        echo "Order item inserted successfully.";
                                    } else {
                                        echo "Error inserting order item: " . mysqli_error($con);
                                    }
                                } else {
                                    echo "No orders found.";
                                }
                            } else {
                                echo "Error fetching orders: " . mysqli_error($con);
                            }
                    
                            if (!$result_update_items) {
                               
                                echo "Error updating items: " . mysqli_error($con);
                            }
                        } else {
                            echo "Item not found for id: $book_id";
                        }
                    }
                    
                    $query_delete_cart = "DELETE FROM cart WHERE c_id = $customerId";
                    $result_delete_cart = mysqli_query($con, $query_delete_cart);

                }
            mysqli_close($con);
            header('Location: cart.php');
            exit();
            }    
        
}   
            

?>
</body>


<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js">
    new Swiper(".swiper", {
        loop: true,
        effect: 'coverflow',
        centeredSlides: true,
        slidesPerView: 'auto',
        speed: 500,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            768: {
                centeredSlides: false,
                coverflowEffect: {
                    depth: 0,
                    rotate: 0,
                    stretch: -10,
                }
            }
        },
        autoplay: {
            delay: 3000,
        },
        coverflowEffect: {
            depth: 80,
            rotate: 50,
            stretch: 20,
        }
    });
    document.querySelector('.container').style.maxWidth = '1200px';
</script>
</body>

    <style>
    .quantity-container {
        display: flex;
        align-items: center;
        font-size: 16px;
        margin-bottom: 10px;
    }

    .quantity-btn {
        background-color: grey;
        color: #fff;
        border: none;
        padding: 3px 8px;
        cursor: pointer;
    }

    .quantity-display {
        margin: 0 3px;
    }
    .checkout-container {
            text-align: center;
            margin-top: 20px;
        }

        .checkout-btn {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
        }
         .remove-btn {
        background-color: #e74c3c; /* Red color */
        color: #fff;
        border: none;
        padding: 3px 8px;
        margin-left: 10px; /* Adjust the spacing as needed */
        cursor: pointer;
    }
    </style>
    </html>