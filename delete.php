<?php
include 'connection.php';

if (isset($_GET['id']) && isset($_GET['table'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $table = mysqli_real_escape_string($con, $_GET['table']);
    
    if ($table === 'customers') { 
       // $ordered_items_query = "DELETE FROM `ordered_items` WHERE o_id IN (SELECT id FROM `orders` WHERE c_id = '$id')";
       // $ordered_items_run = mysqli_query($con, $ordered_items_query);
       // $reviews_query = "DELETE FROM `reviews` WHERE c_id = '$id'";
       // $reviews_run = mysqli_query($con, $reviews_query);
        //$cart_query = "DELETE FROM `cart` WHERE c_id = '$id'";
       // $cart_run = mysqli_query($con, $cart_query); 
      //  $orders_query = "DELETE FROM `orders` WHERE c_id = '$id'";
      //  $orders_run = mysqli_query($con, $orders_query);
      mysqli_query($con, "SET FOREIGN_KEY_CHECKS = 0");
        $query = "DELETE FROM `$table` WHERE id = '$id'";
        $run = mysqli_query($con, $query);
        mysqli_query($con, "SET FOREIGN_KEY_CHECKS = 1");
        
        if ($run) {
            header('location: index.php');
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } elseif ($table === 'items') {
        $reviews_query = "DELETE FROM `reviews` WHERE i_id = '$id'";
        $reviews_run = mysqli_query($con, $reviews_query);
        $ordered_items_query = "DELETE FROM `ordered_items` WHERE i_id = '$id'";
        $ordered_items_run = mysqli_query($con, $ordered_items_query);
        $query = "DELETE FROM `$table` WHERE id = '$id'";
        $run = mysqli_query($con, $query);
    
        if ($run) {
            header('location: item.php');
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Invalid table name.";
    }
} else {
    echo "Invalid parameters.";
}
// Disable foreign key checks
        //mysqli_query($con, "SET FOREIGN_KEY_CHECKS = 0");
        //mysqli_query($con, "SET FOREIGN_KEY_CHECKS = 1");
?>
 