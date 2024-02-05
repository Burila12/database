<?php
session_start();
if(! isset($_SESSION['log_in'])){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<header>
    <img src="book.png" alt="Logo">
    <a href="item.php">GO_BACK</a>
</header>
    <title>Add Item</title>
    <style>
        a {
            color: white;
            align-items: left;
            text-decoration: none;
            margin: 0 20px;
        }
        header {
            background-color: #0d1b2a;
            color: #fff;
            display: flex;
            align-items: center;
            padding: 10px 20px;

        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #0d1b2a;
        }

        .insert-form {
            background-color: #0d1b2a;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .insert-form label, .insert-form input {
            display: block;
            margin-bottom: 10px;
            color: skyblue;
        }

        .insert-form button {
            background-color: skyblue;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="insert-form">
        <form method="post" action="item_insert.php">
            <label for="isbn">ISBN:</label>
            <input type="text" name="isbn"required>
            <label for="title">Title:</label>
            <input type="text" name="title"required>
            <label for="author">Author:</label>
            <input type="text" name="author"required>
            <label for="genre">Genre:</label>
            <input type="text" name="genre"required>
            <label for="price">Price:</label>
            <input type="number" name="price"required>
            <label for="types">Type:</label>
            <input type="text" name="types"required>
            <label for="qty">QTY:</label>
            <input type="number" name="qty"required>
            <button type="submit" name="submit">Insert</button>
        </form>
    </div>
</body>
</html>
<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $isbn = mysqli_real_escape_string($con, $_POST['isbn']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $author = mysqli_real_escape_string($con, $_POST['author']);
    $genre = mysqli_real_escape_string($con, $_POST['genre']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $type = mysqli_real_escape_string($con, $_POST['types']);
    $qty = mysqli_real_escape_string($con, $_POST['qty']);
    $query = "INSERT INTO items (isbn, title, author, genre, price, type, qty) VALUES ('$isbn', '$title', '$author', '$genre', '$price', '$type', '$qty')";
    $result = mysqli_query($con, $query);
    if ($result) {
        header('location:item.php');  
    } else {
        echo "Insert failed: " . mysqli_error($con);
    }
}
?>