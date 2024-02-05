<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'connection.php';

    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $maxqty = $_POST['qty'];

    $checkQuery = "SELECT * FROM cart WHERE c_id = '{$_SESSION['user_id']}' AND book_id = '$title'";
    $checkResult = mysqli_query($con, $checkQuery);
    
    if (!$checkResult) {
        die('Error in SQL query: ' . mysqli_error($con));
    }
    if (mysqli_num_rows($checkResult) == 0) {
       //does The item not exists, so update the quantity
        $insertQuery = "INSERT INTO cart (c_id, book_id, qty) VALUES ('{$_SESSION['user_id']}', '$title', 1)";
        $insertResult = mysqli_query($con, $insertQuery);

        if (!$insertResult) {
            die('Error in SQL query: ' . mysqli_error($con));
        }
    } else {
        // The item exists, so update the quantity
        $updateQuery = "UPDATE cart SET qty = LEAST(qty + 1,$maxqty) WHERE c_id = '{$_SESSION['user_id']}' AND book_id = '$title'";
        $updateResult = mysqli_query($con, $updateQuery);
        if (!$updateResult) {
            die('Error in SQL query: ' . mysqli_error($con));
        }
    }
    mysqli_close($con);
    header('Location: customer.php');
    exit();
}
?>

<?php
if(!isset($_SESSION['login'])){
    header("location:clogin.php");
}
?>
<?php   
 include 'connection.php';  
 $query = "select * from items";  
 $run = mysqli_query($con,$query);  
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
            <li><a class="navbar-brand" href="landing.php">GrimBook</a><li>
            <li><a href="cart.php"><img src="shopbag.png" alt="Logo"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp; My Cart</a></li>
            <li><a href="order_history.php"><img src="recommendations.png" alt="Logo"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp; HISTORY</a></li>
            <li><a href="logout.php"><img src="book.png" alt="Logo"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp; Logout</a></li>
        </ul>
    </div>
</head>
<br>
<br>
<div class="cont-slider">
  <section class="slider">
    <article class="slide one"><span>One</span></article>
    <article class="slide two"><span>Two</span></article>
    <article class="slide three"><span>Three</span></article>
    <article class="slide four"><span>Four</span></article>
  </section>
</div>
<section class="image-slider-container">
    <div class="image-slider-heading">
        <h2 class="image-slider-title">BOOK</h2>
        <div class="swiper-pagination"></div>
    </div>
    <div class="swiper" style="display: flex; align-items: center;">

<?php
  $itemsPerRow = 8; 
  $count = 0; 
  echo '<div class="swiper">'; 
    while ($result = mysqli_fetch_assoc($run)) {
      if ($count % $itemsPerRow == 0) {
        echo '<div class="swiper-row">';
      }
      echo '<div class="swiper-slide">';
      echo '<div class="slide-con">';
      $titleWords = explode(' ', $result['title']);
      $limitedTitle = implode(' ', array_slice($titleWords, 0, 3));
      $remainingContent = implode(' ', array_slice($titleWords, 3));

      echo '<img src="' . $result['img'] . '" alt="Book Cover">';
      echo '<p class="overlay-text" title="' . $result['title'] . '" style="color: white; font-size: 10px;">' . $limitedTitle . '<br>' . $remainingContent . '</p>';
      echo '<div class="slide-details">';
      echo '<div class="label">Title:</div>';
      echo '<div class="book-info">';
      echo '<span class="book-name" title="' . $result['title'] . '">' . $result['title'] . '</span>';
      echo '</div>';
      echo '<div class="label">Author:</div>';
      echo '<div class="book-info">';
      echo '<span class="author" title="' . $result['author'] . '">' . $result['author'] . '</span>';
      echo '</div>';
      echo '<div class="book-btns">';
      echo '<a class="imdb-rate label">';
      if ($result['qty'] > 0) {
        echo 'QTY: ' . $result['qty'];
        } else {
        echo 'Out of stock';
        }
        echo '</a>';
        echo '<a class="imdb-rate label"> Price: ' . $result['price'] . '</a>';
  
        if ($result['qty'] > 0) {

          echo '<form method="post" action="customer.php">';
          echo '<input type="hidden" name="title" value="' . $result['id'] . '">';
          echo '<input type="hidden" name="qty" value="' . $result['qty'] . '">';
          echo '<input type="hidden" name="book_id" value="' . $_SESSION['user_id'] . '">';
          echo '<button href="#" type="submit" class="like">ADD<br>Cart</button>';
          echo '</form>';}
        else {
          echo '<button class="like" disabled>ADD CART</button>';}
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
            $count++;
            if ($count % $itemsPerRow == 0) {
                echo '</div>';
            }
        }
        if ($count % $itemsPerRow != 0) {
            echo '</div>';
        }
        echo '</div>';
      ?>
    </div>
  </section>
</div>
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

<script>

    document.getElementById('cartButton').addEventListener('click', function () {
        var cartDropdown = document.getElementById('cartDropdown');
        cartDropdown.style.display = (cartDropdown.style.display === 'block') ? 'none' : 'block';
    });
</script>
</html>