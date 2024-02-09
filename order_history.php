<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("location: clogin.php");
    exit();
}
include 'connection.php';
$customerId = $_SESSION['user_id'];
$query = "SELECT orders.id AS order_id, orders.date, orders.ship_address, ordered_items.i_id, 
ordered_items.qty, items.title, items.img
FROM orders
LEFT JOIN ordered_items ON orders.id = ordered_items.o_id
LEFT JOIN items ON ordered_items.i_id = items.id
WHERE orders.c_id = $customerId";
          

$result = mysqli_query($con, $query);
if (!$result) {
    die("Error fetching orders: " . mysqli_error($con));
}
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_close($con);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
    <link rel="stylesheet" type="text/css" href="styles.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #edf7ff; /* Initial body background color */
            color: #343a40;
            transition: background-color 0.3s ease; /* Adjusted background color transition duration */
        }

        #navbar {
            background-color: #6c757d;
            padding: 10px 15px;
            color: white;
        }

        .order-history-item {
            background-color: #ffeeba;
            border-radius: 8px;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, background-color 0.3s ease; /* Add color transition */
        }

        .order-history-item:hover {
            transform: scale(1.05);
            background-color: #ffcc80;
        }

        #navbar {
            background-color: #6c757d; /* Initial grey color */
            padding: 10px 15px;
            color: white;
            transition: background-color 0.3s ease; /* Color transition */
        }

        .navbar-nav {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar-nav li {
            display: inline-block;
            margin-right: 15px;
        }

        .navbar-nav a {
            text-decoration: none;
            color: white;
            font-size: 16px;
        }
        #navbar:hover {
    background-color: #495057; /* New color on hover */
}

        .navbar-nav a:hover {
            color: #ffcc00;
        }

        .order-history-item {
            background-color: #ffeeba; /* Initial background color */
            border-radius: 8px;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, background-color 0.3s ease; /* Add color transition */
        }

        .order-history-item:hover {
            transform: scale(1.05);
            background-color: #ffcc80; /* New background color on hover */
        }

        .order-history-container {
            margin: 20px 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .order-history-image {
            max-width: 100%;
            max-height: 150px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .order-history-item:hover {
            transform: scale(1.05);
        }

        .order-details,
        .contact-info {
            margin-top: 20px;
            text-align: center;
            color: #007bff;
        }

        p {
            color: #343a40;
        }
        
    </style>
</head>

<body>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
            <li><a class="navbar-brand" href="customer.php">GrimBook</a><li>
            <li><a href="customer.php"><img src="home.png" alt="Logo"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Home</a></li>
            <li><a href="order_history.php"><img src="recommendations.png" alt="Logo"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp; HISTORY</a></li>
            <li><a href="logout.php"><img src="book.png" alt="Logo"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp; Logout</a></li>
        </ul>
    </div>
</head>
  
    </div>
    <br>
    <br>
    <br>

    <?php
    if (!empty($orders)) {
    ?>
        <h1 style="text-align: center; color: #grey;">Order History</h1>
        <div class="order-history-container">
            <?php foreach ($orders as $order) { ?>
                <div class="order-history-item">
                    <p><strong>Order ID:</strong> <?php echo $order['order_id']; ?></p>
                    <p><strong>Date:</strong> <?php echo $order['date']; ?></p>
                    <p><strong>Shipping Address:</strong> <?php echo $order['ship_address']; ?></p>
                    <p><strong>Item ID:</strong> <?php echo $order['i_id']; ?></p>
                    <p><strong>Quantity:</strong> <?php echo $order['qty']; ?></p>
                    <p><strong>Item Title:</strong> <?php echo $order['title']; ?></p>
                    <img class="order-history-image" src="<?php echo $order['img']; ?>" alt="Item Image">
                    <div class="rate-label">Quantity: <?php echo $order['qty']; ?></div>
                </div>
            <?php } ?>
        </div>

        <div class="order-details">
            <p>We appreciate your choice in selecting Book, and we hope you enjoy every page of it.</p>
        </div>

        <div class="contact-info">
            <p>If you have any questions or concerns regarding your order, feel free to reply to this email or contact our customer support team at <a href="mailto:johnmburila@gmail.com">johnmburila@gmail.com</a></p>
        </div>

        <p style="text-align: center;">Thank you for shopping with us! Happy reading!</p>
        <p style="text-align: center;">Best Regards,</p>
    <?php
    } else {
        echo "<p style='text-align: center;'>No orders found.</p>";
    }
    ?>
</body>

</html>
